<?php

namespace App\Controller\Intranet;

use App\Entity\Client;
use App\Entity\Telephone;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TelephoneController extends AbstractController
{
    /**
     * @Route("/intranet/client/addtel/{client}", name="addTel")
     * @param $client
     * @return Response
     */
    public function addTel($client = 0)
    {
        if ($client != 0) {
            $telephone = new Telephone();
            $telephone->clearId();
        }
        return $this->render('intranet/client/telEdit.html.twig', [
            'telephone' => $telephone,
            'client'  => $client
        ]);
    }

    /**
     * @Route("/intranet/client/edittel/{id}", name="editTel")
     * @param EntityManagerInterface $em
     * @param $id
     * @return Response
     */
    public function editTel(EntityManagerInterface $em, $id = 0)
    {
        if ($id != 0) {
            $telephone = $em->find(Telephone::class, $id);
        } else {
            $telephone = new Telephone();
            $telephone->clearId();
        }
        return $this->render('intranet/client/telEdit.html.twig', [
            'telephone' => $telephone
        ]);
    }

    /**
     * @Route("/intranet/client/savetel/{id}", name="saveTel")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function saveTel(EntityManagerInterface $em, Request $request, $id = 0)
    {
        if ($id != 0) {
            $telephone = $em->find(Telephone::class, $id);
        } else {
            $telephone = new Telephone();
        }
        $tabTel = $request->request->get('fields');
        foreach ($tabTel as $v) {
            switch ($v['name']) {
                case 'nom':
                    $telephone->setNom($v['value']);
                    break;
                case 'label':
                    $telephone->setLabel($v['value']);
                    break;
                case 'telephone':
                    $telephone->setTelephone($v['value']);
                    break;
                case 'client':
                    $telephone->setClient($em->find(Client::class, $v['value']));
                    break;
            }
        }
        $em->persist($telephone);
        $em->flush();
        return $this->render('intranet/client/telShow.html.twig', [
            'telephone' => $telephone
        ]);
    }

    /**
     * @Route("/intranet/client/deltel/{id}", name="delTel")
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    public function delTel(EntityManagerInterface $em, int $id = null)
    {
        if ($id != null) {
            $tel = $em->find(Telephone::class, $id);
            if ($tel != null) {
                $em->remove($tel);
                $em->flush();
            }
        }
        return new Response("");
    }

    /**
     * @Route("/intranet/client/canceltel/{id}", name="cancelTel")
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    public function cancelTel(EntityManagerInterface $em, $id = 0)
    {
        if ($id != null) {
            $telephone = $em->find(Telephone::class, $id);
            return $this->render('intranet/client/telShow.html.twig', [
                'telephone' => $telephone
            ]);
        }
        return new Response("");
    }
}
