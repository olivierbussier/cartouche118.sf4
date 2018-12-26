<?php

namespace App\Controller\Intranet;

use App\Entity\Commande;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    /**
     * @Route("/intranet/commande/view/{ref}", name="view_commandes")
     */
    public function index($ref = 0)
    {
        if ($ref == 0) {
            return $this->redirectToRoute('view_clients');
        }
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();

        $fac = $em->getRepository(Commande::class);

        $commande = $fac->find(['id' => $ref]);

        return $this->render('intranet/commande/index.html.twig', [
            'commande' => $commande
        ]);
    }
}
