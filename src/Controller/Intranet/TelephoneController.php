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
     * @Route("/intranet/client/savetel/{id}", name="saveTel")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function saveTel(EntityManagerInterface $em, Request $request, int $id = 0)
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
        return $this->render('intranet/client/phone/telShow.html.twig', [
            'telephone' => $telephone
        ]);
    }

    /**
     * @Route("/intranet/client/deltel/{id}", name="delTel")
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    public function delTel(EntityManagerInterface $em, int $id = 0)
    {
        if ($id != 0) {
            $tel = $em->find(Telephone::class, $id);
            if ($tel != null) {
                $em->remove($tel);
                $em->flush();
            }
        }
        return new Response("");
    }
}
