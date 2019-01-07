<?php

namespace App\Controller\Intranet;

use App\Entity\Commande;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use WhiteOctober\TCPDFBundle\Controller\TCPDFController;


class FactureController extends AbstractController
{
    /**
     * @Route("/intranet/facture/{id}", name="viewfacture")
     * @param TCPDFController $pdfObj
     * @param EntityManagerInterface $em
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewFacture(TCPDFController $pdfObj, EntityManagerInterface $em, $id = 0)
    {
        if ($id == 0) {
            return $this->redirectToRoute('root');
        }

        $comrep = $em->getRepository(Commande::class);

        /** @var Commande $commande */
        $commande = $comrep->find(['id' => $id]);


        $pdf = $pdfObj->create();

        // set document information
        $factId = date('Ymd') . '-' . $commande->getId();
        $pdf->SetCreator('Cartouche 118');
        $pdf->SetAuthor('Olivier Bussier');
        $pdf->SetTitle("Facture - No : ". $factId);
        $pdf->SetSubject('Facture');
        $pdf->SetKeywords('Facture');

        // set default header data

        $pdf->SetHeaderData('logo.jpg', 80, $factId, $factId);

        // set header and footer fonts
        $pdf->setHeaderFont(Array('helvetica', '', 10));
        $pdf->setFooterFont(Array('helvetica', '', 6));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont('courier');

        // set margins
        $pdf->SetMargins(5, 25, 5);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(5);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 15);

        // set image scale factor
        $pdf->setImageScale(1.25);

        // set font
        $pdf->SetFont('helvetica', 'B', 20);

        // add a page
        $pdf->AddPage();

        //$pdf->Write(0, 'Example of HTML tables', '', 0, 'L', true, 0, false, false, 0);

        $pdf->SetFont('helvetica', '', 8);

        $tbl = $this->render('intranet/facture/facturePDF.html.twig', [
            'commande' => $commande
        ]);

        $pdf->writeHTML($tbl->getContent(), true, false, false, false, '');
        $pdf->Output('example_048.pdf', 'I');
    }
}
