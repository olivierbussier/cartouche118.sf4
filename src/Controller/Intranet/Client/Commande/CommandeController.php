<?php

namespace App\Controller\Intranet\Client\Commande;

use App\Entity\Client;
use App\Entity\Commande;
use App\Entity\LigneCommande;
use App\Entity\Produit;
use App\Entity\UnikId;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    /**
     * @Route("/intranet/client/commande/addcommande/{clientId}", name="addCommande")
     * @param EntityManagerInterface $em
     * @param int $clientId
     * @return Response
     */
    public function addCommande(EntityManagerInterface $em, $clientId = 0)
    {
        if ($clientId != 0) {
            $client = $em->find(Client::class, $clientId);
            if ($client !== null) {
                // Recherche si une commande "Draft" existe déjà
                $cmd = null;
                foreach ($client->getCommandes() as $commande) {
                    if ($commande->getStatus() == Commande::DRAFT) {
                        $cmd = $commande;
                        break;
                    }
                }
                if ($cmd === null) {
                    $cmd = new Commande();
                    $cmd->clearId();
                    $cmd->setCreatedAt(new \DateTime());
                    $cmd->setClient($client);

                    $cmd->setStatus(Commande::DRAFT);

                    $line = new LigneCommande();
                    $line->setCreatedAt(new \DateTime());
                    $cmd->addLigneCommande($line);
                    $line->setStatus(LigneCommande::DRAFT);

                    $ref = $em->getRepository(UnikId::class)->getNewId();
                    $cmd->setReference($ref);

                    $em->persist($line);
                    $em->persist($cmd);
                    $em->flush();
                }
            } else {
                return new Response("");
            }
        }
        return $this->render('intranet/commande/commandeEdit.html.twig', [
            'commande' => $cmd
        ]);
    }

    /**
     * @Route("/intranet/client/commande/editcommande/{id}", name="editCommande")
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    public function editCommande(EntityManagerInterface $em, $id = 0)
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
     * @Route("/intranet/client/commande/savecommande/{id}", name="saveCommande")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function saveCommande(EntityManagerInterface $em, Request $request, $id = 0)
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
     * @Route("/intranet/client/commande/cancelcommande/{id}", name="cancelCommande")
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    public function cancelCommande(EntityManagerInterface $em, $id = 0)
    {

        if ($id !== 0) {
            $commande = $em->find(Commande::class, $id);
            // Suppression des lignes de la commande
            foreach ($commande->getLigneCommandes() as $ligne) {
                $em->remove($ligne);
            }
            $em->remove($commande);
            $em->flush();
        }
        return new Response("");
    }

    /**
     * @Route("/intranet/client/commande/deletecommande/{id}", name="delCommande")
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    public function delCommande(EntityManagerInterface $em, $id = 0)
    {
        $client = $em->find(Client::class, $id);

        // Mise a true de l'indicateur d'invalidité du contact

        $client->setDeleted(true);
        $em->persist($client);
        $em->flush();

        return new Response("");
    }

    /**
     * @Route("/intranet/client/commande/addlinecommande/{id}", name="addLineCommande")
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    public function addLineCommande(EntityManagerInterface $em, $id = 0)
    {
        $flash = "";
        // Check if all previous are submitted

        if ($id != 0) {
            $commande = $em->find(Commande::class, $id);

            $lignes = $commande->getLigneCommandes();
            foreach ($lignes as $ligne) {
                if ($ligne->getStatus() === LigneCommande::DRAFT) {
                    $flash = "Il reste des lignes existantes à compléter";
                }
            }
            if ($flash == "") {
                $ligne = new LigneCommande();
                $ligne->setCreatedAt(new \DateTime());
                $ligne->setStatus(LigneCommande::DRAFT);
                $commande->addLigneCommande($ligne);
                $em->persist($ligne);
                $em->flush();
            }
            return $this->render('intranet/commande/commandeEdit.html.twig', [
                'commande' => $commande,
                'flash' => $flash
            ]);
        }
        return new Response("");
    }

    /**
     * @Route("/intranet/client/commande/autocompleteproduit", name="autocompleteProduit")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return Response
     */
    public function autocompleteProduit(EntityManagerInterface $em, Request $request)
    {
        $search = $request->query->get('query');

        $res = $em->getRepository(Produit::class)->getSearchAjax($search);

        $suggestions = [];
        /** @var Produit $produit */
        foreach ($res as $produit) {
            $suggestions[] = [
                'value' =>
                    $produit->getFournisseur()->getNom().'/'.
                    $produit->getCode().'/'.
                    $produit->getNom().'/'.
                    $produit->getCaract1().'/'.
                    $produit->getCaract2().'/',

                'data' => [
                    'Marque' => $produit->getMarque()->getNom(),
                    'prix' => $produit->getPrixHT(),
                    'id' => $produit->getId()]
            ];
        }
        $resp = json_encode([
            "query" => "Unit",
            'suggestions' => $suggestions
        ]);

        return new Response($resp);
    }
}
