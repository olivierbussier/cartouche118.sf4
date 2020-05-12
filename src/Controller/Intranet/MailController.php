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
        return $this->render('intranet/client/mail/mailShow.html.twig', [
            'mail' => $mail
        ]);
    }

    /**
     * @Route("/intranet/client/delmail/{id}", name="delMail")
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    public function delMail(EntityManagerInterface $em, int $id = 0)
    {
        if ($id != 0) {
            $mail = $em->find(Email::class, $id);
            if ($mail != null) {
                $em->remove($mail);
                $em->flush();
            }
        }
        return new Response("");
    }
}
