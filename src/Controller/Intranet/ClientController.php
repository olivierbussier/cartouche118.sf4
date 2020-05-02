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
            'term' => $recherche,
            'currentPage' => $startPage,
            'nbItems' => Config::NB_ITEM_PAR_PAGE,
            'nbPages' => ((int)($nbClients / Config::NB_ITEM_PAR_PAGE)) +
                (($nbClients % Config::NB_ITEM_PAR_PAGE) != 0 ? 1 : 0)
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

    /**
     * @Route("/intranet/client/editclient/{id}", name="editClient")
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    public function editClient(EntityManagerInterface $em, $id = 0)
    {
        if ($id == 0) {
            return $this->redirectToRoute('view_clients');
        }
        $client = $em->find(Client::class, $id);

        return $this->render('intranet/client/clientEdit.html.twig', [
            //'clients' => $clients,
            'client' => $client
        ]);
    }

    /**
     * @Route("/intranet/client/saveclient/{id}", name="saveClient")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function saveClient(EntityManagerInterface $em, Request $request, $id = 0)
    {
        if ($id != 0) {
            $client = $em->find(Client::class, $id);
        } else {
            $client = new Client();
        }
        $tabClient = $request->request->get('fields');
        foreach ($tabClient as $v) {
            switch ($v['name']) {
                case 'nom':
                    $client->setNom($v['value']);
                    break;
                case 'prenom':
                    $client->setPrenom($v['value']);
                    break;
                case 'full':
                    $client->setFullName($v['value']);
                    break;
            }
        }
        $em->persist($client);
        $em->flush();
        return $this->render('intranet/client/clientShow.html.twig', [
            'client' => $client
        ]);
    }

    /**
     * @Route("/intranet/client/cancelclient/{id}", name="cancelClient")
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    public function cancelClient(EntityManagerInterface $em, $id = 0)
    {
        $client = $em->find(Client::class, $id);

        return $this->render('intranet/client/clientShow.html.twig', [
            //'clients' => $clients,
            'client' => $client
        ]);
    }

    /**
     * @Route("/intranet/client/deleteclient/{id}", name="delClient")
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    public function delClient(EntityManagerInterface $em, $id = 0)
    {
        $client = $em->find(Client::class, $id);

        // Mise a true de l'indicateur d'invalidité du contact

        $client->setDeleted(true);
        $em->persist($client);
        $em->flush();

        return new Response("");
    }
}
