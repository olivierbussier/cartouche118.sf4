<?php

namespace App\Controller\Intranet;

use App\Classes\Config\Config;
use App\Entity\Client;
use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @Route("/intranet/client/view/{startPage}", name="view_clients")
     */
    public function index($startPage = 0)
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();

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
     * @Route("/intranet/client/ajaxSearch", name="ajax_search_clients")
     */
    public function ajaxSearch(Request $request)
    {
        $r = new Response();

        $term = $request->request->get('term');
        $r->setContent('ok');

        $em = $this->getDoctrine()->getManager();

        $cr = $em->getRepository(Client::class);

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
