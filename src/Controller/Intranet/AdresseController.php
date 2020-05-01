<?php

namespace App\Controller\Intranet;

use App\Classes\Config\Config;
use App\Entity\Adresse;
use App\Entity\Client;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdresseController extends AbstractController
{
    /**
     * @Route("/intranet/client/addadr/{client}", name="addAdr")
     * @param $client
     * @return Response
     */
    public function addAdr($client = 0)
    {
        if ($client != 0) {
            $adresse = new Adresse();
            $adresse->setId(0);
        }
        return $this->render('intranet/client/adrEdit.html.twig', [
            'adresse' => $adresse,
            'client'  => $client
        ]);
    }

    /**
     * @Route("/intranet/client/editadr/{id}", name="editAdr")
     * @param EntityManagerInterface $em
     * @param $id
     * @return Response
     */
    public function editAdr(EntityManagerInterface $em, $id = 0)
    {
        if ($id != 0) {
            $adresse = $em->find(Adresse::class, $id);
        } else {
            $adresse = new Adresse();
            $adresse->setId(0);
        }
        return $this->render('intranet/client/adrEdit.html.twig', [
            'adresse' => $adresse
        ]);
    }

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
        return $this->render('intranet/client/adrShow.html.twig', [
            'adresse' => $adresse
        ]);
    }

    /**
     * @Route("/intranet/client/deladr/{id}", name="delAdr")
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    public function delAdr(EntityManagerInterface $em, int $id = null)
    {
        if ($id != null) {
            $adr = $em->find(Adresse::class, $id);
            if ($adr != null) {
                $em->remove($adr);
                $em->flush();
            }
        }
        return new Response("");
    }

    /**
     * @Route("/intranet/client/canceladr/{id}", name="cancelAdr")
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    public function cancelAddr(EntityManagerInterface $em, $id = 0)
    {
        if ($id != null) {
            $adresse = $em->find(Adresse::class, $id);
            return $this->render('intranet/client/adrShow.html.twig', [
                'adresse' => $adresse
            ]);
        }
        return new Response("");
    }
}
