<?php

namespace App\Controller;

use App\Classes\VCF\VCard;
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
use Doctrine\Common\Persistence;
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

    /**
     * Importation de la base "contacts.vcf"
     *
     * @Route("/importvcf", name="importvcf")
     * @param EntityManagerInterface $em
     * @return Response
     * @throws Exception
     */
    public function importVCF(EntityManagerInterface $em)
    {


        $cards = new VCard('contacts.vcf');

        $this->delData(Note::class);
        $this->delData(Telephone::class);
        $this->delData(Email::class);
        $this->delData(Adresse::class);
        $this->delData(Commande::class);
        $this->delData(LigneCommande::class);
        $this->delData(Client::class);
        $this->delData(Produit::class);

        // Création des clients et des notes

        //$parser = VCardParser::parseFromFile('contacts.vcf');
        //$parser = VCardParser::parseFromFile('test.vcf');
        //$cards = $parser->getCards();

        $types = [
            'FAX'  => 'Fax',
            'WORK' => 'Travail',
            'CELL' => 'Portable',
            'HOME' => 'Maison',
            'INTERNET' => 'Générique',
            'INTERNET;WORK' => 'Travail',
            'INTERNET;HOME' => 'Maison',
            'WORK;POSTAL' => 'Travail'
        ];

        $i=0;

        foreach ($cards as $k => $v) {
            $client = new Client();
            $client->setPrenom($v->n[0]['FirstName']);
            $client->setNom($v->n[0]['LastName']);
            $client->setFullName($v->fn[0]['Value']);
            $client->setAdditional($v->n[0]['AdditionalNames']);
            $client->setType('personne_physique');
            foreach ($v->email as $vmel) {
                $mel = new Email();
                $mel->setClient($client);
                $mel->setNom($vmel['Type'][0]);
                if (isset($vmel['label'])) {
                    $mel->setLabel($vmel['label']);
                }
                $mel->setEmail($vmel['Value']);
                $em->persist($mel);
            }
            foreach ($v->tel as $kpho => $vpho) {
                $pho = new Telephone();
                $pho->setClient($client);
                $pho->setNom($vpho['Type'][0]);
                if (isset($vpho['label'])) {
                    $pho->setLabel($vpho['label']);
                }
                $pho->setTelephone($vpho['Value']);
                $em->persist($pho);
            }
            foreach ($v->note as $n) {
                $note = new Note();
                $note->setClient($client);
                $note->setCreatedAt(new DateTime());
                $note->setText($this->convertString($n['Value']));
                $em->persist($note);
            }
            foreach ($v->adr as $vadr) {
                $adr = new Adresse();
                $adr->setClient($client);
                $adr->setNom($vadr['Type'][0]);
                $adr->setAdresse1($this->convertString($vadr['StreetAddress']));
                $adr->setAdresse2($this->convertString($vadr['ExtendedAddress']));
                $adr->setVille($this->convertString($vadr['Locality']));
                $adr->setCodePostal($vadr['PostalCode']);
                $adr->setPays($vadr['Country']);
                $em->persist($adr);
            }
            $em->persist($client);
            if ($i++ % 200 == 0) {
                $em->flush();
            }
        }
        $em->flush();

        return $this->render('intranet/rebase.html.twig', [
            'varTitre' => 'Importation VCF'
        ]);
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
                $client = $repoCl->find(rand(1, $nbClients - 1));
                $commande->setClient($client);
                $dat = $fak->dateTimeBetween('-5 years', 'now');
                $commande->setCreatedAt($dat);
                $commande->setReference($dat->format('Ymd-hms') . '-' . $commande->getClient());
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
                }
            }
            $em->flush();
        }
        return $this->render('intranet/rebase.html.twig', [
            'varTitre' => "Création de $nbCommandes commandes"
        ]);
    }
}
