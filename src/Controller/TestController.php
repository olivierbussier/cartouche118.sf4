<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\CategorieProduit;
use App\Entity\Client;
use App\Entity\Email;
use App\Entity\Facture;
use App\Entity\Fournisseur;
use App\Entity\Note;
use App\Entity\Produit;
use App\Entity\Taxe;
use App\Entity\LigneFacture;
use App\Entity\Telephone;
use JeroenDesloovere\VCard\VCardParser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
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

    const product = [                   //               C+       PS        papyr
        [ 'Imprimante Laser Canon'      , 230.00, [0 => [0], 1 => [1], 2 => [2]]],
        [ 'Imprimante Inkjet Canon'     , 130.00, [0 => [0], 1 => [1], 2 => [2]]],
        [ 'Imprimante Laser HP'         , 200.00, [0 => [0], 1 => [ ], 2 => [ ]]],
        [ 'Imprimante Inkjet HP'        , 100.00, [0 => [0], 1 => [ ], 2 => [ ]]],
        [ 'Imprimante Laser Epson'      , 180.00, [0 => [ ], 1 => [1], 2 => [ ]]],
        [ 'Imprimante Inkjet Epson'     ,  90.00, [0 => [ ], 1 => [1], 2 => [ ]]],
        [ 'Encre Canon laser neuf'      ,  82.00, [0 => [ ], 1 => [4], 2 => [ ]]],
        [ 'Encre Canon laser reman'     ,  22.00, [0 => [3], 1 => [ ], 2 => [ ]]],
        [ 'Encre Canon laser recharge'  ,  12.00, [0 => [3], 1 => [ ], 2 => [ ]]],
        [ 'Encre Canon inkjet neuf'     ,  60.00, [0 => [ ], 1 => [4], 2 => [ ]]],
        [ 'Encre Canon inkjet reman'    ,  30.00, [0 => [3], 1 => [ ], 2 => [ ]]],
        [ 'Encre Canon inkjet recharge' ,  28.00, [0 => [3], 1 => [ ], 2 => [ ]]],
        [ 'Encre HP laser neuf'         ,  82.00, [0 => [ ], 1 => [4], 2 => [ ]]],
        [ 'Encre HP laser reman'        ,  22.00, [0 => [3], 1 => [ ], 2 => [ ]]],
        [ 'Encre HP laser recharge'     ,  12.00, [0 => [3], 1 => [ ], 2 => [ ]]],
        [ 'Encre HP inkjet neuf'        ,  60.00, [0 => [ ], 1 => [4], 2 => [ ]]],
        [ 'Encre HP inkjet reman'       ,  30.00, [0 => [3], 1 => [ ], 2 => [ ]]],
        [ 'Encre HP inkjet recharge'    ,  28.00, [0 => [3], 1 => [ ], 2 => [ ]]],
        [ 'Encre Epson laser neuf'      ,  82.00, [0 => [ ], 1 => [4], 2 => [ ]]],
        [ 'Encre Epson laser reman'     ,  22.00, [0 => [3], 1 => [ ], 2 => [ ]]],
        [ 'Encre Epson laser recharge'  ,  12.00, [0 => [3], 1 => [ ], 2 => [ ]]],
        [ 'Encre Epson inkjet neuf'     ,  60.00, [0 => [ ], 1 => [4], 2 => [ ]]],
        [ 'Encre Epson inkjet reman'    ,  30.00, [0 => [3], 1 => [ ], 2 => [ ]]],
        [ 'Encre Epson inkjet recharge' ,  28.00, [0 => [3], 1 => [ ], 2 => [ ]]],
        [ 'Papier'                      ,   3.28, [0 => [ ], 1 => [4], 2 => [5]]]
    ];

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

    private function getRand(array $arr)
    {
        $cnt = count($arr);
        $rnd = rand(0, $cnt-1);
        return $arr[$rnd];
    }

    /**
     * @Route("/cretab/{nbClients}/{nbFact}", name="test1")
     * @param int $nbClients
     * @param int $nbFact
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function createTables($nbClients = 100, $nbFact = 10)
    {

        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();

        $this->delData(LigneFacture::class);
        $this->delData(Facture::class);
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

        $fak = \Faker\Factory::create('fr_FR');

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
                $nt->setCreatedAt(new \DateTime($fak->date()));
                $nt->setText($fak->text(800));
                $em->persist($nt);
            }
            $em->persist($cl);
            $clients[] = $cl;
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
            $fourn = $c[2];
            foreach ($fourn as $k => $v) {
                foreach ($v as $target) {
                    $pr = new Produit();
                    $pr->setCategorieProduit($cat[$target]);
                    $pr->setNom($libelle);
                    $pr->setPrixHT($prix);
                    $em->persist($pr);
                    $prd[] = $pr;
                }
            }
        }

        // Creation des factures

        $factures = [];

        for ($i=0; $i<$nbFact; $i++) {
            $fac = new Facture();
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
                $lf = new LigneFacture();
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

                $fac->addLigneFacture($lf);
                $em->persist($lf);
            }
            $em->persist($fac);
            $factures[] = $fac;
        }
        $em->flush();

        return $this->render('intranet/test.html.twig');
    }

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
     * @Route("/importvcf", name="importvcf")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function createCli()
    {

        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();

        $this->delData(LigneFacture::class);
        $this->delData(Facture::class);
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

        $parser = VCardParser::parseFromFile('contacts.vcf');
        $cards = $parser->getCards();

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
            $client->setPrenom($v->firstname);
            $client->setNom($v->lastname);
            $client->setFullName($v->fullname);
            $client->setAdditional($v->additional);
            if (isset($v->email)) {
                foreach ($v->email as $kmel => $vmel) {
                    foreach ($vmel as $indmail) {
                        $mel = new Email();
                        $mel->setClient($client);
                        $mel->setNom($types[$kmel]);
                        $mel->setEmail($indmail);
                        $em->persist($mel);
                    }
                }
            }
            if (isset($v->phone)) {
                foreach ($v->phone as $kpho => $vpho) {
                    foreach ($vpho as $indpho) {
                        $pho = new Telephone();
                        $pho->setClient($client);
                        $pho->setNom($types[$kmel]);
                        $pho->setTelephone($indpho);
                        $em->persist($pho);
                    }
                }
            }
            if (isset($v->note)) {
                $note = new Note();
                $note->setClient($client);
                $note->setCreatedAt(new \DateTime());
                $note->setText($this->convertString($v->note));
                $em->persist($note);
            }
            if (isset($v->address)) {
                foreach ($v->address as $kadr => $vadr) {
                    foreach ($vadr as $indadr) {
                        $adr = new Adresse();
                        $adr->setClient($client);
                        $adr->setNom($types[$kadr]);
                        $adr->setAdresse1($this->convertString($indadr->street));
                        $adr->setAdresse2($this->convertString($indadr->extended));
                        $adr->setVille($this->convertString($indadr->city));
                        $adr->setCodePostal($indadr->zip);
                        $adr->setPays($indadr->country);
                        $em->persist($adr);
                    }
                }
            }
            $em->persist($client);
            if ($i++ % 500 == 0) {
                $em->flush();
            }
        }
        $em->flush();

        return $this->render('intranet/test.html.twig');
    }

    /**
     * @Route("/facture", name="test2")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function facture(Request $request)
    {
        $fRepo = $this->getDoctrine()->getRepository(Facture::class);
        $prod = $fRepo->findAll();

        //$form = $this->createForm(FactureType::class, $prod[0]);
        //$form->handleRequest($request);

        //if ($form->isSubmitted() && $form->isValid()) {

        //}


        return $this->render('pages/test.html.twig', [
            'data' => $prod
        ]);
    }
}
