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

        return $this->render('intranet/client/index.html.twig', [
            'clients' => $clients,
            'term'    => $recherche,
            'currentPage' => $startPage,
            'nbItems' => Config::NB_ITEM_PAR_PAGE,
            'nbPages' => ((int)($nbClients / Config::NB_ITEM_PAR_PAGE)) +
                (($nbClients % Config::NB_ITEM_PAR_PAGE) != 0 ? 1 : 0)
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
        $cr = $em->getRepository(Client::class);

        $client = $cr->find($id);

        return $this->render('intranet/client/show_client.html.twig', [
            //'clients' => $clients,
            'client' => $client
        ]);
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
        $nbPages = ((int)($nbClients / Config::NB_ITEM_PAR_PAGE)) +
            (($nbClients % Config::NB_ITEM_PAR_PAGE) != 0 ? 1 : 0);

        if ($nbPages == 0) {
            // Rien a afficher
            $pageNb = 0;
        } elseif ($pageNb > $nbPages - 1) {
            // Le nombre de pages a diminué, il faut recharger les éléments à afficher
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
