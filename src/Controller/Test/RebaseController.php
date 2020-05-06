<?php

namespace App\Controller\Test;

use App\Classes\VCF\VCardParser;
use App\Entity\Adresse;
use App\Entity\CategorieProduit;
use App\Entity\Client;
use App\Entity\Email;
use App\Entity\Commande;
use App\Entity\Fournisseur;
use App\Entity\LigneCommande;
use App\Entity\Marque;
use App\Entity\Note;
use App\Entity\Produit;
use App\Entity\Taxe;
use App\Entity\Telephone;
use App\Repository\ClientRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RebaseController extends AbstractController
{

    const tva = ['TVAHT',                     'percentHT', '20.00', ];

    const taxe = [
        ['C+ : Eco Participation Encre',   'fixHT',     '0.02', 3],
        ['C+ : Eco Participation printer', 'fixHT',     '0.84', 0],
        ['PS : Eco Participation Encre',   'fixHT',     '0.05', 4],
        ['PS : Eco Participation printer', 'fixHT',     '1.20', 1],
        ['PR : Eco Participation printer', 'fixHT',     '2.20', 2],
    ];

    const fournisseur = [
        ['CartouchePlus'  ],
        ['PrinterShop'    ],
        ['Papyrusse'      ]
    ];

    const category = [            // C+ PS PR
        ['Imprimante' , [0,1,2]], //  0  1 2
        ['Cartouche'  , [0,1]  ], //  3  4
        ['Papier'     , [2]    ]  //  5
    ];

    const marques = [
        'Canon' => 1,
        'HP'    => 2,
        'Epson' => 3,
        'Papelard' => 4
    ];

    const product = [                   //               C+       PS        papyr
        [ 'Imprimante Laser Canon'      , 230.00, 1, [0 => [0], 1 => [1], 2 => [2]]],
        [ 'Imprimante Inkjet Canon'     , 130.00, 1, [0 => [0], 1 => [1], 2 => [2]]],
        [ 'Imprimante Laser HP'         , 200.00, 2, [0 => [0], 1 => [ ], 2 => [ ]]],
        [ 'Imprimante Inkjet HP'        , 100.00, 2, [0 => [0], 1 => [ ], 2 => [ ]]],
        [ 'Imprimante Laser Epson'      , 180.00, 3, [0 => [ ], 1 => [1], 2 => [ ]]],
        [ 'Imprimante Inkjet Epson'     ,  90.00, 3, [0 => [ ], 1 => [1], 2 => [ ]]],
        [ 'Encre Canon laser neuf'      ,  82.00, 1, [0 => [ ], 1 => [4], 2 => [ ]]],
        [ 'Encre Canon laser reman'     ,  22.00, 1, [0 => [3], 1 => [ ], 2 => [ ]]],
        [ 'Encre Canon laser recharge'  ,  12.00, 1, [0 => [3], 1 => [ ], 2 => [ ]]],
        [ 'Encre Canon inkjet neuf'     ,  60.00, 1, [0 => [ ], 1 => [4], 2 => [ ]]],
        [ 'Encre Canon inkjet reman'    ,  30.00, 1, [0 => [3], 1 => [ ], 2 => [ ]]],
        [ 'Encre Canon inkjet recharge' ,  28.00, 1, [0 => [3], 1 => [ ], 2 => [ ]]],
        [ 'Encre HP laser neuf'         ,  82.00, 2, [0 => [ ], 1 => [4], 2 => [ ]]],
        [ 'Encre HP laser reman'        ,  22.00, 2, [0 => [3], 1 => [ ], 2 => [ ]]],
        [ 'Encre HP laser recharge'     ,  12.00, 2, [0 => [3], 1 => [ ], 2 => [ ]]],
        [ 'Encre HP inkjet neuf'        ,  60.00, 2, [0 => [ ], 1 => [4], 2 => [ ]]],
        [ 'Encre HP inkjet reman'       ,  30.00, 2, [0 => [3], 1 => [ ], 2 => [ ]]],
        [ 'Encre HP inkjet recharge'    ,  28.00, 2, [0 => [3], 1 => [ ], 2 => [ ]]],
        [ 'Encre Epson laser neuf'      ,  82.00, 3, [0 => [ ], 1 => [4], 2 => [ ]]],
        [ 'Encre Epson laser reman'     ,  22.00, 3, [0 => [3], 1 => [ ], 2 => [ ]]],
        [ 'Encre Epson laser recharge'  ,  12.00, 3, [0 => [3], 1 => [ ], 2 => [ ]]],
        [ 'Encre Epson inkjet neuf'     ,  60.00, 3, [0 => [ ], 1 => [4], 2 => [ ]]],
        [ 'Encre Epson inkjet reman'    ,  30.00, 3, [0 => [3], 1 => [ ], 2 => [ ]]],
        [ 'Encre Epson inkjet recharge' ,  28.00, 3, [0 => [3], 1 => [ ], 2 => [ ]]],
        [ 'Papier'                      ,   3.28, 4, [0 => [ ], 1 => [4], 2 => [5]]]
    ];

    /**
     * @param $dd
     */
    private function delData($dd)
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();

        $pcRepo = $doctrine->getRepository($dd);
        $prod = $pcRepo->findAll();

        foreach ($prod as $p) {
            $em->remove($p);
        }
        $em->flush();
    }

    /**
     * @param array $arr
     * @return mixed
     */
    private function getRand(array $arr)
    {
        return $arr[rand(0, count($arr)-1)];
    }

    /**
     * Création d'une base complète
     *
     * @Route("/cretab/{nbClients}/{nbCommandes}", name="crebase")
     * @param int $nbClients
     * @param int $nbCommandes
     * @return Response
     * @throws Exception
     */
    public function createTables($nbClients = 100, $nbCommandes = 100)
    {

        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();

        $this->delData(LigneCommande::class);
        $this->delData(Commande::class);
        $this->delData(Produit::class);
        $this->delData(Note::class);
        $this->delData(Telephone::class);
        $this->delData(Email::class);
        $this->delData(Adresse::class);
        $this->delData(Client::class);
        $this->delData(Taxe::class);
        $this->delData(CategorieProduit::class);
        $this->delData(Fournisseur::class);

        // Création des clients et des notes

        $clients = [];

        $fak = Factory::create('fr_FR');

        $adrType = ['Maison', 'pro', 'Home'];

        for ($x=0; $x<$nbClients; $x++) {
            $cl = new Client();
            $prenom = $fak->firstName;
            $nom    = $fak->lastName;
            $cl->setPrenom($prenom);
            $cl->setNom($nom);
            $cl->setFullName($prenom . ' ' . $nom);
            $cl->setAdditional($fak->title);
            $nadr = rand(1, 3);
            for ($i=0; $i<$nadr; $i++) {
                $adr = new Adresse();
                $adr->setNom($adrType[rand(0, 2)]);
                $adr->setAdresse1($fak->streetAddress);
                $adr->setCodePostal($fak->postcode);
                $adr->setVille($fak->city);
                $adr->setPays($fak->country);
                $em->persist($adr);
                $cl->addAdress($adr);
            }
            $ntel = rand(1, 3);
            for ($i=0; $i<$ntel; $i++) {
                $tl = new Telephone();
                $tl->setNom($adrType[rand(0, 2)]);
                $tl->setTelephone($fak->phoneNumber);
                $em->persist($tl);
                $cl->addTelephone($tl);
            }
            $nmel = rand(1, 3);
            for ($i=0; $i<$nmel; $i++) {
                $ml = new Email();
                $ml->setNom($adrType[rand(0, 2)]);
                $ml->setEmail($fak->companyEmail);
                $em->persist($ml);
                $cl->addEmail($ml);
            }
            $nNotes = rand(0, 4);
            for ($j=0; $j<$nNotes; $j++) {
                $nt = new Note();
                $nt->setClient($cl);
                $nt->setCreatedAt(new DateTime($fak->date()));
                $nt->setText($fak->text(800));
                $em->persist($nt);
            }
            $em->persist($cl);
            $clients[] = $cl;
        }

        // Création des marques

        $marques = [];
        foreach (self::marques as $n => $m) {
            $mq = new Marque();
            $mq->setNom($n);
            $em->persist($mq);
            $marques[] = $mq;
        }

        // Création des fournisseurs

        $fou = [];
        foreach (self::fournisseur as $c) {
            $ct = new Fournisseur();
            $ct->setNom($c[0]);
            $ct->setAdresse($fak->address);
            $ct->setMail($fak->email);
            $ct->setTelephone($fak->phoneNumber);
            $em->persist($ct);
            $fou[] = $ct;
        }

        // Création des catégories produit

        $cat = [];
        foreach (self::category as $c) {
            $fr = $c[1];
            foreach ($fr as $f) {
                $ct = new CategorieProduit();
                $ct->setNom($c[0]);
                $ct->setTva(20.0);
                $ct->setFournisseur($fou[$f]);
                $em->persist($ct);
                $cat[] = $ct;
            }
        }

        // Creation des taxes

        $tax = [];
        foreach (self::taxe as $c) {
            $t = new Taxe();
            $t->setNom($c[0]);
            $t->setType($c[1]);
            $t->setMontant($c[2]);
            /** @var CategorieProduit $cpr */
            $cpr = $cat[$c[3]];
            $t->setCategorieProduit($cpr);
            $cpr->addTax($t);
            $em->persist($t);
            $tax[] = $t;
        }

        // Création des produits

        $prd = [];
        foreach (self::product as $c) {
            $libelle= $c[0];
            $prix = $c[1];
            $marq = $c[2];
            $fourn = $c[3];
            foreach ($fourn as $k => $v) {
                foreach ($v as $target) {
                    $pr = new Produit();
                    $pr->setCategorieProduit($cat[$target]);
                    $pr->setNom($libelle);
                    $pr->setPrixHT($prix);
                    $pr->setMarque($marques[$marq-1]);
                    $em->persist($pr);
                    $prd[] = $pr;
                }
            }
        }

        // Creation des commandes

        $commandes = [];

        for ($i=0; $i<$nbCommandes; $i++) {
            $fac = new Commande();
            $fac->setClient($this->getRand($clients));
            $dat = $fak->dateTimeBetween('-5 years', 'now');
            $fac->setCreatedAt($dat);
            $fac->setReference($dat->format('Ymd') . '-' . $fac->getClient());
            $fac->setPrixHT(0);
            $fac->setEcoHT(0);
            $fac->setEcoTTC(0);
            // Creation des ventes
            $rnd = rand(1, 12);
            for ($j=0; $j<$rnd; $j++) {
                $lf = new LigneCommande();
                $lf->setCreatedAt($dat);
                /** @var Produit $pr */
                $pr = $this->getRand($prd);
                $lf->setRemiseType('percent');
                $lf->setRemise(0);

                $quan = rand(1, 10);
                $lf->setQuantite($quan);

                $fac->setPrixHT($fac->getPrixHT() + $pr->getPrixHT() * $quan);
                $tva = $pr->getCategorieProduit()->getTva();
                $fac->setPrixTTC($fac->getPrixTTC() + $pr->getPrixHT() * $quan * (1+$tva/100.0));
                $lf->setProduit($pr);
                // Ecotaxes
                foreach ($pr->getCategorieProduit()->getTaxes() as $tax) {
                    /** @var Taxe $tax */
                    $fac->setEcoHT($fac->getEcoHT() + $quan * $tax->getMontant());
                    $fac->setEcoTTC($fac->getEcoTTC() + $quan * $tax->getMontant() * 1.2);
                }

                $fac->addLigneCommande($lf);
                $em->persist($lf);
            }
            $em->persist($fac);
            $commandes[] = $fac;
        }
        $em->flush();

        return $this->render('intranet/rebase.html.twig', [
            'varTitre' => 'Génération aléatoire'
        ]);
    }

    /**
     * @param String $text
     * @return mixed
     */
    private function convertString(String $text)
    {
        $text = str_replace("\\'", "'", $text);
        $text = str_replace("\\,", ",", $text);
        $text = str_replace("\\:", ":", $text);
        $text = str_replace("\\r\\n", "\n", $text);
        $text = str_replace("\\n\\r", "\n", $text);
        $text = str_replace("\\n", "\n", $text);
        return str_replace("\\r", "\n", $text);
    }

    private function convertType(string $type)
    {
        $types = [
            'fax'           => 'Fax',
            'work'          => 'Travail',
            'cell'          => 'Portable',
            'home'          => 'Maison',
            'n'             => 'Par defaut',
            'internet'      => 'Mail',
            'internet;work' => 'Mail pro',
            'internet;home' => 'Mail perso',
            'work;postal'   => 'Adresse pro',
            'default'       => 'Tel par defaut',
            'main'          => 'Tel principal',
            'pager'         => 'Tel pager'
        ];

        foreach ($types as $k => $v) {
            if (strtolower($type) == $k) {
                return $v;
            }
        }
        echo "erreur de traitement : $type\n"; exit;
        return $type;
    }

    private function getField($array, $field, $default = "[absent]")
    {
        if (isset($array[$field])) {
            return $array[$field];
        } else {
            return $default;
        }
    }

    private $content = "";

    private function prt($field, $array)
    {
        $this->content .= "$field  : '".$this->getField($array, $field)."'\n";
    }

    private function convertText($string)
    {
        //echo "<pre>$string</pre>\n";
        $b = str_replace("\\n", "\n", $string);
        $b = str_replace("\\,", ",", $b);
        $b = str_replace("\\:", ":", $b);
        $b = str_replace("\\\"", "\"", $b);
        return $b;
    }

    /**
     * Importation de la base "contacts.vcf"
     *
     * @Route("/test", name="test")
     * @param EntityManagerInterface $em
     * @return Response
     * @throws Exception
     */
    public function test(EntityManagerInterface $em)
    {

        //$pattern = "#^mysql://([1-9a-z]*):([1-9a-zA-Z]+)@([1-9.]+):([1-9]+)\/([0-9a-zA-Z]+)#";

        /**************************************************************
         *  Ce script est executé en crontab afin de réaliser le backup
         *  Des bases de production
         */

        $retention = 15; // Dur�e de r�tention (en jours) des bases que l'on souhaite
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
            return new Response("");
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
                        $return .= "  ".$key." = '".$mysql->quote($value)."'";
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
                        // V�rifie si trop vieux
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

        return new Response("");
    }

    /**
     * Importation de la base "contacts.vcf"
     *
     * @Route("/importvcf", name="importVCF")
     * @param EntityManagerInterface $em
     * @return Response
     * @throws Exception
     */
    public function importVCF(EntityManagerInterface $em)
    {

        $content = "";

        $cards = VCardParser::parseFromFile('contacts.vcf');

        $this->delData(Note::class);
        $this->delData(Telephone::class);
        $this->delData(Email::class);
        $this->delData(Adresse::class);
        $this->delData(LigneCommande::class);
        $this->delData(Produit::class);
        $this->delData(Commande::class);
        $this->delData(Client::class);

        // Création des clients et des notes

        $Index=0;
        foreach ($cards as $index => $card) {
            $Index++;
            $client = new Client();
            $client->setDeleted(false);
            $client->setType('personne_physique');
            foreach ($card as $key0 => $item0) {
                switch (strtolower($key0)) {
                    // Champs textes
                    case 'version':
                        break;
                    case 'title':
                        $client->setTitre($item0);
                        break;
                    case 'photo':
                        $client->setPhoto($item0);
                        break;
                    case 'organization':
                        $client->setOrganization($item0);
                        break;
                    case 'fullname':
                        $client->setFullName($item0);
                        break;
                    case 'lastname':
                        $client->setNom($item0);
                        break;
                    case 'firstname':
                        $client->setPrenom($item0);
                        break;
                    case 'additional':
                        $client->setAdditional($item0);
                        break;
                    case 'prefix':
                        $client->setPrefix($item0);
                        break;
                    case 'suffix':
                        $client->setSuffix($item0);
                        break;

                    // Champs note

                    case 'note':
                        $note = new Note();
                        $note->setText($this->convertText($item0));
                        $note->setCreatedAt(new DateTime('now'));
                        $note->setClient($client);
                        $em->persist($note);
                        break;

                    // Champs structurés

                    case 'categories':
                        break;

                    case 'url':
                        break;

                    case 'address':
                        //$tab = $this->getStructured($item0);
                        foreach ($item0 as $k => $v) {
                            $adr = new Adresse();
                            $adr->setNom($this->convertType($v[0]));
                            $adr->setLabel($v[1]);
                            if (!is_object($v[2])) {
                                $content .= "Erreur sur le traitement d'une adresse : ".print_r($item0, true)."\n";
                                return new Response("<pre>$content</pre>");
                            }
                            foreach ($v[2] as $key => $value) {
                                switch (strtolower($key)) {
                                    case 'name':
                                        $adr->setBP($value);
                                        break;
                                    case 'extended':
                                        $adr->setAdresse2($this->convertText($value));
                                        break;
                                    case 'street':
                                        $adr->setAdresse1($this->convertText($value));
                                        break;
                                    case 'city':
                                        $adr->setVille($value);
                                        break;
                                    case 'region':
                                        $adr->setRegion($value);
                                        break;
                                    case 'zip':
                                        $adr->setCodePostal($value);
                                        break;
                                    case 'country':
                                        $adr->setPays($value);
                                        break;

                                    default:
                                        $content .= "Erreur sur le traitement adresse : clé non traitée".$key."\n";
                                        return new Response("<pre>$content</pre>");
                                        break;
                                }
                            }
                            $adr->setClient($client);
                            $em->persist($adr);
                        }
                        break;

                    case 'email':
                        //$tab = $this->getStructured($item0);
                        foreach ($item0 as $k => $v) {
                            $mail = new Email();
                            $mail->setNom($this->convertType($v[0]));
                            $mail->setLabel($v[1]);
                            $mail->setEmail($v[2]);
                            $mail->setClient($client);
                            $em->persist($mail);
                        }
                        break;
                    case 'phone':
                        //$tab = $this->getStructured($item0);
                        foreach ($item0 as $k => $v) {
                            $tel = new Telephone();
                            $tel->setNom($this->convertType($v[0]));
                            $tel->setLabel($v[1]);
                            $tel->setTelephone($v[2]);
                            $tel->setClient($client);
                            $em->persist($tel);
                        }
                        break;

                    case 'nickname':
                    case 'role':
                        break;

                    default:
                        echo "erreur, champ '$key0' non traité\n";
                        exit;
                        break;
                }
            }
            $em->persist($client);
            if ($Index % 500 == 0) {
                $em->flush();
            }
        }
        $em->flush();
        $content .= "Terminé : $Index traités\n";
        return new Response("<pre>$content</pre>");
    }

    private function val($str)
    {
        $px = explode(',', $str);
        return (float)($px[0] . '.' . $px[1]);
    }

    /**
     * Recherche d'un objet (comparaison par rapport au nom retourné par __toString)
     *
     * @param string $val
     * @param array $arr
     * @return mixed
     */
    private function searchName(string $val, array $arr)
    {
        foreach ($arr as $k) {
            $test = $k;
            if ($test == $val) {
                return $k;
            }
        }
        return false;
    }

    /**
     * Recherche d'un objet catégorie ayant les caractéristiques suivantes :
     *  - même nom
     *  - même fournisseur
     *
     * @param string $cat
     * @param string $fournisseur
     * @param array $categs
     * @return mixed
     */
    private function searchCat(string $cat, string $fournisseur, array $categs)
    {
        foreach ($categs as $k) {
            /** @var $k CategorieProduit */
            if ($k->getNom() == $cat) {
                if ($k->getFournisseur() == $fournisseur) {
                    return $k;
                }
            }
        }
        return false;
    }

    /**
     * Import d'un fichier de produits
     *
     * @Route("/produitscsv", name="produitscsv")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function importCSV(EntityManagerInterface $em)
    {
        $authorizedTitres = [
            'code',
            "nom",
            "categorie",
            "fournisseur",
            "marque",
            "caract1",
            "caract2",
            "prixht",
            "tva",
            "ecotaxe",
            "marge"
        ];

        $this->delData(Produit::class);
        $this->delData(Taxe::class);
        $this->delData(CategorieProduit::class);
        $this->delData(Fournisseur::class);
        $this->delData(Marque::class);

        $categories = [];
        $produits = [];
        $fournisseurs = [];
        $marques = [];
        $taxes = [];

        $mm = 0;

        if (($handle = fopen("test.csv", "r")) !== false) {
            if (($data = fgetcsv($handle, 1000, ";")) !== false) {
                // Ligne de titres
                $titres = [];
                foreach ($data as $v) {
                    $test = ord($v[0]);
                    if ($test == 0xef) {
                        $v = substr($v, 3);
                        //$v = $v2;
                    }
                    $v = trim($v);
                    if (!in_array($v, $authorizedTitres)) {
                        echo "<p>Titre incorrect : '$v', les titres de colonnes doivent etre dans la liste suivante :</p><ul>";
                        foreach ($authorizedTitres as $tv) {
                            echo "<li>$tv</li>";
                        }
                        echo "</ul>";
                        exit;
                    }
                    $titres[] = $v;
                }

                while (($data = fgetcsv($handle, 1000, ";")) !== false) {
                    $i = 0;
                    foreach ($data as $v) {
                        $ligne[$titres[$i++]] = $v;
                    }

                    $prd = new Produit();

                    $prd->setCode($ligne['code']);
                    $prd->setNom($ligne['nom']);

                    $prd->setPrixHT($this->val($ligne['prixht']));
                    $prd->setMarge($this->val($ligne['marge']));
                    $prd->setCaract1($ligne['caract1']);
                    $prd->setCaract2($ligne['caract2']);

                    // Marque

                    if (($marque = $this->searchName($ligne['marque'], $marques)) == false) {
                        $marque = new Marque();
                        $marque->setNom($ligne['marque']);
                        $marque->setDescription('Aucune');

                        $em->persist($marque);
                        $marques[] = $marque;
                    }
                    $prd->setMarque($marque);

                    // Fournisseur

                    if (($fournisseur = $this->searchName($ligne['fournisseur'], $fournisseurs)) == false) {
                        $fournisseur = new Fournisseur();
                        $fournisseur->setNom($ligne['fournisseur']);
                        $fournisseur->setAdresse('Aucune');
                        $fournisseur->setMail('Aucune');
                        $fournisseur->setTelephone('Aucune');

                        $em->persist($fournisseur);
                        $fournisseurs[] = $fournisseur;
                    }
                    $prd->setFournisseur($fournisseur);

                    // Categorie

                    if (($categorie = $this->searchCat($ligne['categorie'], $ligne['fournisseur'], $categories)) == false) {
                        $categorie = new CategorieProduit();
                        $categorie->setNom($ligne['categorie']);
                        $categorie->setFournisseur($fournisseur);
                        $categorie->setTva($this->val($ligne['tva']));

                        $em->persist($categorie);
                        $categories[] = $categorie;

                        // EcoTaxe

                        $targetTaxe = new Taxe();

                        $targetTaxe->setCategorieProduit($categorie);
                        $targetTaxe->setFournisseur($fournisseur);
                        $targetTaxe->setMontant($this->val($ligne['ecotaxe']));
                        $targetTaxe->setNom($categorie.'-'.$fournisseur);
                        $targetTaxe->setType('ECO');

                        $em->persist($targetTaxe);
                        $taxes[] = $targetTaxe;
                    }
                    $prd->setCategorieProduit($categorie);

                    $produits[] = $prd;

                    $em->persist($prd);
                    if ($mm++ % 100 == 0) {
                        $em->flush();
                    }
                }
            }
            $em->flush();
            fclose($handle);
        }
        return $this->render('intranet/rebase.html.twig', [
            'varTitre' => 'Importation fichier CSV Produits'
        ]);
    }

    /**
     * Création de commandes
     *
     * @Route("/createcommandes/{nbCommandes}", name="createcommandes")
     * @param ManagerRegistry $doctrine
     * @param EntityManagerInterface $em
     * @param int $nbCommandes
     * @return Response
     * @throws Exception
     */
    public function createCommandes(ManagerRegistry $doctrine, EntityManagerInterface $em, $nbCommandes = 2000)
    {

        if (!is_numeric($nbCommandes)) {
            if ($nbCommandes == 'raz') {
                $this->delData(LigneCommande::class);
                $this->delData(Commande::class);
            }
        } else {
            $fak = Factory::create('fr_FR');

            // Creation des commandes

            $repoCl = $doctrine->getRepository(Client::class);
            $repoPr = $doctrine->getRepository(Produit::class);

            /** @var ClientRepository $repoCl */
            /** @var ClientRepository $repoPr */

            $nbClients = $repoCl->count([]);
            $nbProducts = $repoPr->count([]);

            $x = 0;

            for ($i = 0; $i < $nbCommandes; $i++) {
                $commande = new Commande();
                $client = $repoCl->find(rand(1, $nbClients));
                $commande->setClient($client);
                $dat = $fak->dateTimeBetween('-5 years', 'now');
                $commande->setCreatedAt($dat);
                $commande->setReference("commande-".$client->getNom());
                $commande->setPrixHT(0);
                $commande->setEcoHT(0);
                $commande->setEcoTTC(0);
                // Creation des ventes
                $rnd = rand(1, 12);
                for ($j = 0; $j < $rnd; $j++) {
                    $lf = new LigneCommande();
                    $lf->setCreatedAt($dat);
                    /** @var Produit $pr */
                    $pr = $repoPr->find(rand(1, $nbProducts - 1));
                    $lf->setRemiseType('percent');
                    $lf->setRemise(0);

                    $quan = rand(1, 10);
                    $lf->setQuantite($quan);

                    $commande->setPrixHT($commande->getPrixHT() + $pr->getPrixHT() * $quan);
                    $tva = $pr->getCategorieProduit()->getTva();
                    $commande->setPrixTTC($commande->getPrixTTC() + $pr->getPrixHT() * $quan * (1 + $tva));
                    $lf->setProduit($pr);
                    // Ecotaxes
                    foreach ($pr->getCategorieProduit()->getTaxes() as $tax) {
                        /** @var Taxe $tax */
                        $commande->setEcoHT($commande->getEcoHT() + $quan * $tax->getMontant());
                        $commande->setEcoTTC($commande->getEcoTTC() + $quan * $tax->getMontant() * 1.2);
                    }

                    $commande->addLigneCommande($lf);
                    $em->persist($lf);
                }
                $em->persist($commande);

                if ($x++ % 500 == 0) {
                    $em->flush();
                    $em->clear(LigneCommande::class);
                    $em->clear(Commande::class);
                }
            }
            $em->flush();
            $em->clear(LigneCommande::class);
            $em->clear(Commande::class);
        }
        return $this->render('intranet/rebase.html.twig', [
            'varTitre' => "Création de $nbCommandes commandes"
        ]);
    }
}
