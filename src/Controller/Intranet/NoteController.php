<?php

namespace App\Controller\Intranet;

use App\Classes\Config\Config;
use App\Entity\Adresse;
use App\Entity\Client;
use App\Entity\Note;
use App\Repository\ClientRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NoteController extends AbstractController
{
    /**
     * @Route("/intranet/client/addnote/{client}", name="addNote")
     * @param $client
     * @return Response
     */
    public function addNote($client = 0)
    {
        if ($client != 0) {
            $note = new Note();
            $note->clearId();
        }
        return $this->render('intranet/client/noteEdit.html.twig', [
            'note' => $note,
            'client'  => $client
        ]);
    }

    /**
     * @Route("/intranet/client/editnote/{id}", name="editNote")
     * @param EntityManagerInterface $em
     * @param $id
     * @return Response
     */
    public function editNote(EntityManagerInterface $em, $id = 0)
    {
        $note = $em->find(Note::class, $id);
        return $this->render('intranet/client/noteEdit.html.twig', [
            'note' => $note
        ]);
    }

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
        return $this->render('intranet/client/noteShow.html.twig', [
            'note' => $note
        ]);
    }

    /**
     * @Route("/intranet/client/delnote/{id}", name="delNote")
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    public function delNote(EntityManagerInterface $em, int $id = null)
    {
        if ($id != null) {
            $note = $em->find(Note::class, $id);
            if ($note != null) {
                $em->remove($note);
                $em->flush();
            }
        }
        return new Response("");
    }

    /**
     * @Route("/intranet/client/cancelnote/{id}", name="cancelNote")
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    public function cancelNote(EntityManagerInterface $em, $id = 0)
    {
        if ($id != null) {
            $note = $em->find(Note::class, $id);
            return $this->render('intranet/client/noteShow.html.twig', [
                'note' => $note
            ]);
        }
        return new Response("");
    }
}
