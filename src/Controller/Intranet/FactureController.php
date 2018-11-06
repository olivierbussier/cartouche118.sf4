<?php

namespace App\Controller\Intranet;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FactureController extends AbstractController
{
    /**
     * @Route("/intranet/facture/view", name="view_factures")
     */
    public function index()
    {
        return $this->render('facture/index.html.twig', [
            'controller_name' => 'FactureController',
        ]);
    }
}
