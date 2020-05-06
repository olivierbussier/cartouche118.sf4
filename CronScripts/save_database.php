#!/usr/local/bin/php
<?php
//$pattern = "#^mysql://([1-9a-z]*):([1-9a-zA-Z]+)@([1-9.]+):([1-9]+)\/([0-9a-zA-Z]+)#";

/**************************************************************
 *  Ce script est executé en crontab afin de réaliser le backup
 *  Des bases de production
 */

$retention = 15; // Durée de rétention (en jours) des bases que l'on souhaite
$backup_dir = "backups/";

$file = file("d:/devweb/sf4.cartouche118/CronScripts/env");

foreach ($file as $line) {
    $items = explode('=', $line);
    if ($items[0] == 'DATABASE_URL') {
        $cnx = $items[1];
    }
}

$pattern = "#^mysql://([1-9a-z]*):([1-9a-z]*)@([0-9a-zA-Z.]*):([0-9]+)/([0-9a-zA-Z]+)#";

$ret = preg_match(
    $pattern,
    $cnx,
    $result
);

$user = $result[1];
$pwd = $result[2];
$name = $result[3];
$port = $result[4];
$database = $result[5];

// Start cnx database

$mysql = new \PDO("mysql:host=$name;dbname=$database", $user, $pwd);

echo ">>> Start backup\n";

$datef = date("Y_m_d_H_i_");
$zip = new \ZipArchive();

$filename = __DIR__."/".$backup_dir.$datef."backup.zip";

echo " - Création de l'archive ".$filename." : ";
if ($zip->open($filename, \ZipArchive::CREATE)!== true) {
    echo "*** ERR : Impossible d'ouvrir le fichier <$filename>\n";
    return 2;
}
echo "OK\n";

//get all of the tables

//echo " - Liste des tables a sauvegarder\n";

$tables = array();

foreach ($mysql->query('SHOW TABLES') as $row) {
    $tables[] = $row["Tables_in_$database"];
    //echo "   * ".$row["Tables_in_".$base_de_donnees]."\n";
}
//echo " - Fin de la liste des tables a sauvegarder\n";

//cycle through
foreach ($tables as $table) {
    $return = "";
    //echo " - Backup de '".$table."' : ";

    $return.= 'DROP TABLE IF EXISTS '.$table.';';

    $row2 = $mysql->query('SHOW CREATE TABLE '.$table)->fetch();
    $return.= "\n\n".$row2["Create Table"].";\n\n";

    foreach ($mysql->query("SELECT * FROM $table") as $row) {
        $return .= "INSERT INTO $table set ";
        $j=0;
        foreach ($row as $key => $value) {
            if ($value != '') {
                if ($j++ > 0) {
                    $return .= ', ';
                }
                $return .= "  ".$key." = ".$mysql->quote($value);
            }
        }
        $return .= ";\n";
    }
    $return .= "\n\n\n";
    //save file

    $file = __DIR__."/".$backup_dir."tmp_".$table.".sql";
    $handle = fopen($file, 'w+');
    if ($handle == false) {
        echo "   -> *** ERR ".$table." (".$file.")\n";
    } else {
        fwrite($handle, $return);
        fclose($handle);
        //echo $file." cr�e\n";
        $zip->addFile($file, $datef.$table.".sql");
        $file_to_del[] = $file;
    }
}
//echo " ---- Fin des backups\n";
//echo " - Nombre de fichiers : " . $zip->numFiles . "\n";
//echo " - Statut ZIP :" . $zip->status . "\n";
if ($zip->close() === true) {
    echo " - Cloture ZIP : OK\n";
} else {
    echo " *** ERR : Probleme de cloture ZIP - ".$zip->getStatusString()."\n";
}

//echo " - Suppression des fichiers temporaires\n";
foreach ($file_to_del as $file) {
    //echo "    -> Suppression de ".$file. " : ";
    if (unlink($file) == false) {
        echo "*** ERR : Suppression de ".$file."\n";
    }
}
//echo " - Fin de suppression des fichiers temporaires\n";

/*********************************************************
 *  Purge des backups trop anciens
 */

echo " - Purge des backups hors dur�e de r�tention\n";

// Enum�ration des fichiers du r�pertoire backup

$d = dir(__DIR__."/".$backup_dir);
while (false !== ($entry = $d->read())) {
    switch ($entry) {
        case ".":
        case "..":
            break;
        default:
            $det = explode("_", $entry);
            if (!isset($det[0]) || !isset($det[1]) || !isset($det[2])) {
                break;
            }
            if (!is_numeric($det[0]) || !is_numeric($det[0]) || !is_numeric($det[0])) {
                break;
            }
            // Cr�ation de la date du fichier
            if (($date = new DateTime($det[0]."-".$det[1]."-".$det[2])) == false) {
                break;
            } else {
                // Vérifie si trop vieux
                $now = new DateTime();
                $now->setTime(0, 0, 0);
                $now->sub(new DateInterval('P'.$retention.'D'));
                if ($date < $now) {
                    unlink(__DIR__."/".$backup_dir.$entry);
                    echo "   -> Fichier ".__DIR__."/".$backup_dir.$entry." supprim�\n";
                }
            }
            break;
    }
}
$d->close();
echo "<<< End backup\n";
