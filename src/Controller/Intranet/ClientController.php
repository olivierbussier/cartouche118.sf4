<?php

namespace App\Controller\Intranet;

use App\Classes\Config\Config;
use App\Entity\Client;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @Route("/intranet/client/list/{startPage}/{recherche}", name="view_clients")
     * @param EntityManagerInterface $em
     * @param string $recherche
     * @param int $startPage
     * @return Response
     */
    public function index(EntityManagerInterface $em, $startPage = 0, $recherche = '')
    {
        $cr = $em->getRepository(Client::class);

        /** @var ClientRepository $cr */
        $clients = $cr->getFilterAndPagination($recherche, $startPage);
        $nbClients = count($clients);

        //$clients = $cr->findBy([], ['nom' => 'asc'], Config::NB_ITEM_PAR_PAGE, $startPage * Config::NB_ITEM_PAR_PAGE, Config::NB_ITEM_PAR_PAGE, $startPage * Config::NB_ITEM_PAR_PAGE);

        return $this->render('intranet/client/index.html.twig', [
            'clients' => $clients,
            'term'    => $recherche,
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
        $pageNb = $request->request->get('pageNb');
        $r->setContent('ok');

        $cr = $em->getRepository(Client::class);

        /** @var ClientRepository $cr */
        $clients = $cr->getFilterAndPagination($term, $pageNb);
        $nbClients = count($clients);
        $nbPages = ((int)($nbClients / Config::NB_ITEM_PAR_PAGE)) + (($nbClients % Config::NB_ITEM_PAR_PAGE) != 0 ? 1 : 0);

        if ($nbPages == 0) {
            $pageNb = 0;
        } elseif ($pageNb > $nbPages - 1) {
            $pageNb = $nbPages - 1;
            $clients = $cr->getFilterAndPagination($term, $pageNb);
        }

        return $this->render('intranet/client/render_list_client.html.twig', [
            //'clients' => $clients,
            'term' => $term,
            'clients' => $clients,
            'currentPage' => $pageNb,
            'nbPages' => $nbPages
        ]);
    }
}
