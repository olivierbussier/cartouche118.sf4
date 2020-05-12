<?php

namespace App\Controller\Intranet;

use App\Entity\Client;
use App\Entity\Note;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NoteController extends AbstractController
{
    /**
     * @Route("/intranet/client/savenote/{id}", name="saveNote")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function saveNote(EntityManagerInterface $em, Request $request, int $id = 0)
    {
        if ($id != 0) {
            $note = $em->find(Note::class, $id);
        } else {
            $note = new Note();
        }
        $tabNote = $request->request->get('fields');
        foreach ($tabNote as $v) {
            switch ($v['name']) {
                case 'createdat':
                    $note->setCreatedAt(new DateTime($v['value']));
                    break;
                case 'text':
                    $note->setText($v['value']);
                    break;
                case 'client':
                    $note->setClient($em->find(Client::class, $v['value']));
                    break;
            }
        }
        $em->persist($note);
        $em->flush();
        return $this->render('intranet/client/note/noteShow.html.twig', [
            'note' => $note
        ]);
    }

    /**
     * @Route("/intranet/client/delnote/{id}", name="delNote")
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    public function delNote(EntityManagerInterface $em, int $id = 0)
    {
        if ($id != 0) {
            $note = $em->find(Note::class, $id);
            if ($note != null) {
                $em->remove($note);
                $em->flush();
            }
        }
        return new Response("");
    }
}
