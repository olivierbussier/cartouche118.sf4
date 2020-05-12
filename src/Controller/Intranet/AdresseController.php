<?php

namespace App\Controller\Intranet;

use App\Entity\Adresse;
use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdresseController extends AbstractController
{

    /**
     * @Route("/intranet/client/saveadr/{id}", name="saveAdr")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function saveAdr(EntityManagerInterface $em, Request $request, int $id = 0)
    {
        if ($id != 0) {
            $adresse = $em->find(Adresse::class, $id);
        } else {
            $adresse = new Adresse();
        }
        $tabAdress = $request->request->get('fields');
        foreach ($tabAdress as $v) {
            switch ($v['name']) {
                case 'nom':
                    $adresse->setNom($v['value']);
                    break;
                case 'adr1':
                    $adresse->setAdresse1($v['value']);
                    break;
                case 'adr2':
                    $adresse->setAdresse2($v['value']);
                    break;
                case 'cp':
                    $adresse->setCodePostal($v['value']);
                    break;
                case 'ville':
                    $adresse->setVille($v['value']);
                    break;
                case 'bp':
                    $adresse->setBP($v['value']);
                    break;
                case 'pays':
                    $adresse->setPays($v['value']);
                    break;
                case 'region':
                    $adresse->setRegion($v['value']);
                    break;
                case 'client':
                    $adresse->setClient($em->find(Client::class, $v['value']));
                    break;
            }
        }
        $em->persist($adresse);
        $em->flush();
        return $this->render('intranet/client/adress/adrShow.html.twig', [
            'adresse' => $adresse
        ]);
    }

    /**
     * @Route("/intranet/client/deladr/{id}", name="delAdr")
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    public function delAdr(EntityManagerInterface $em, int $id = 0)
    {
        if ($id != 0) {
            $adr = $em->find(Adresse::class, $id);
            if ($adr != null) {
                $em->remove($adr);
                $em->flush();
            }
        }
        return new Response("");
    }
}
