<?php

namespace App\Controller\Intranet;

use App\Entity\Facture;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FactureController extends AbstractController
{
    /**
     * @Route("/intranet/facture/view/{ref}", name="view_factures")
     */
    public function index($ref = 0)
    {
        if ($ref == 0) {
            $this->redirect('view_clients');
        }
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();

        $fac = $em->getRepository(Facture::class);

        $facture = $fac->find(['id' => $ref]);

        return $this->render('intranet/facture/index.html.twig', [
            'facture' => $facture
        ]);
    }
}
