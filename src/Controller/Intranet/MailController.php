<?php

namespace App\Controller\Intranet;

use App\Entity\Client;
use App\Entity\Email;
use App\Entity\Telephone;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MailController extends AbstractController
{
    /**
     * @Route("/intranet/client/addmail/{client}", name="addMail")
     * @param $client
     * @return Response
     */
    public function addMail($client = 0)
    {
        if ($client != 0) {
            $mail = new Email();
            $mail->clearId();
        }
        return $this->render('intranet/client/mailEdit.html.twig', [
            'mail' => $mail,
            'client'  => $client
        ]);
    }

    /**
     * @Route("/intranet/client/editmail/{id}", name="editMail")
     * @param EntityManagerInterface $em
     * @param $id
     * @return Response
     */
    public function editMail(EntityManagerInterface $em, $id = 0)
    {
        if ($id != 0) {
            $mail = $em->find(Email::class, $id);
        } else {
            $mail = new Email();
            $mail->clearId();
        }
        return $this->render('intranet/client/mailEdit.html.twig', [
            'mail' => $mail
        ]);
    }

    /**
     * @Route("/intranet/client/savemail/{id}", name="saveMail")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function saveMail(EntityManagerInterface $em, Request $request, int $id = 0)
    {
        if ($id != 0) {
            $mail = $em->find(Email::class, $id);
        } else {
            $mail = new Email();
        }
        $tab = $request->request->get('fields');
        foreach ($tab as $v) {
            switch ($v['name']) {
                case 'nom':
                    $mail->setNom($v['value']);
                    break;
                case 'label':
                    $mail->setLabel($v['value']);
                    break;
                case 'email':
                    $mail->setEmail($v['value']);
                    break;
                case 'client':
                    $mail->setClient($em->find(Client::class, $v['value']));
                    break;
            }
        }
        $em->persist($mail);
        $em->flush();
        return $this->render('intranet/client/mailShow.html.twig', [
            'mail' => $mail
        ]);
    }

    /**
     * @Route("/intranet/client/delmail/{id}", name="delMail")
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    public function delMail(EntityManagerInterface $em, int $id = null)
    {
        if ($id != null) {
            $mail = $em->find(Email::class, $id);
            if ($mail != null) {
                $em->remove($mail);
                $em->flush();
            }
        }
        return new Response("");
    }

    /**
     * @Route("/intranet/client/cancelmail/{id}", name="cancelMail")
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    public function cancelMail(EntityManagerInterface $em, $id = 0)
    {
        if ($id != null) {
            $mail = $em->find(Email::class, $id);
            return $this->render('intranet/client/mailShow.html.twig', [
                'mail' => $mail
            ]);
        }
        return new Response("");
    }
}
