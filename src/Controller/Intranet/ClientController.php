<?php

namespace App\Controller\Intranet;

use App\Classes\Config\Config;
use App\Entity\Client;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @Route("/intranet/client/list/{startPage}", name="view_clients")
     * @param EntityManagerInterface $em
     * @param int $startPage
     * @return Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function index(EntityManagerInterface $em, $startPage = 0)
    {
        $cr = $em->getRepository(Client::class);

        /** @var ClientRepository $cr */
        $nbClients = $cr->countEntity();

        $clients = $cr->findBy([], ['nom' => 'asc'], Config::NB_ITEM_PAR_PAGE, $startPage * Config::NB_ITEM_PAR_PAGE);

        return $this->render('intranet/client/index.html.twig', [
            //'clients' => $clients,
            'clients' => $clients,
            'currentPage' => $startPage,
            'nbItems' => Config::NB_ITEM_PAR_PAGE,
            'nbPages' => ((int)($nbClients / Config::NB_ITEM_PAR_PAGE)) + (($nbClients % Config::NB_ITEM_PAR_PAGE) != 0 ? 1 : 0)
        ]);
    }

    /**
     * @Route("/intranet/client/show/{id}", name="show_client")
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    public function show(EntityManagerInterface $em, $id = 0)
    {
        if ($id == 0) {
            return $this->redirectToRoute('view_clients');
        }
        return new Response("ok : id = $id");
    }

    /**
     * @Route("/intranet/client/ajaxSearch", name="ajax_search_clients")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function ajaxSearch(Request $request, EntityManagerInterface $em)
    {
        $r = new Response();

        $term = $request->request->get('term');
        $r->setContent('ok');

        $q = $em->createQuery("select u from App\\Entity\\Client u where u.nom like '%$term%' or u.prenom like '%$term%' or u.fullName like '%$term%'");
        $users = $q->getResult();
        $resp = [];
        foreach ($users as $v) {
            /** @var Client $v */
            $resp[] = '(' . $v->getFullName() .') ' . $v->getNom() . ', ' . $v->getPrenom();
        }

        $r->setContent(json_encode($resp));
        return $r;
    }
}
