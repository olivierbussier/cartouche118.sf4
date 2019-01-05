<?php

namespace App\Controller\Intranet;

use App\Entity\Commande;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use WhiteOctober\TCPDFBundle\Controller\TCPDFController;
use WhiteOctober\TCPDFBundle\WhiteOctoberTCPDFBundle;


class FactureController extends AbstractController
{

//============================================================+
// File name   : tcpdf_config.php
// Begin       : 2004-06-11
// Last Update : 2013-05-16
//
// Description : Example of alternative configuration file for TCPDF.
// Author      : Nicola Asuni - Tecnick.com LTD - www.tecnick.com - info@tecnick.com
// License     : GNU-LGPL v3 (http://www.gnu.org/copyleft/lesser.html)
// -------------------------------------------------------------------
// Copyright (C) 2004-2013  Nicola Asuni - Tecnick.com LTD
//
// This file is part of TCPDF software library.
//
// TCPDF is free software: you can redistribute it and/or modify it
// under the terms of the GNU Lesser General Public License as
// published by the Free Software Foundation, either version 3 of the
// License, or (at your option) any later version.
//
// TCPDF is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
// See the GNU Lesser General Public License for more details.
//
// You should have received a copy of the GNU Lesser General Public License
// along with TCPDF.  If not, see <http://www.gnu.org/licenses/>.
//
// See LICENSE.TXT file for more information.
//============================================================+

    /**
     * Example of alternative configuration file for TCPDF.
     * @author Nicola Asuni
     * @package com.tecnick.tcpdf
     * @version 4.9.005
     * @since 2004-10-27
     */

    /**
     * Define the following constant to ignore the default configuration file.
     */
    const K_TCPDF_EXTERNAL_CONFIG = true;


    /**
     * Deafult image logo used be the default Header() method.
     * Please set here your own logo or an empty string to disable it.
     */
    const PDF_HEADER_LOGO = 'logo.jpg';

    /**
     * Header logo image width in user units.
     */
    const PDF_HEADER_LOGO_WIDTH = 30;

    /**
     * Cache directory for temporary files (full path).
     *
define ('K_PATH_CACHE', sys_get_temp_dir().'/');

    /**
     * Generic name for a blank image.
     *
define ('K_BLANK_IMAGE', '_blank.png');

    /**
     * Page format.
     *
define ('PDF_PAGE_FORMAT', 'A4');

    /**
     * Page orientation (P=portrait, L=landscape).
     *
define ('PDF_PAGE_ORIENTATION', 'P');

    /**
     * Document creator.
     */
    const PDF_CREATOR = 'TCPDF';

    /**
     * Document author.
     *
define ('PDF_AUTHOR', 'TCPDF');

    /**
     * Header title.
     *
define ('PDF_HEADER_TITLE', 'TCPDF Example');

    /**
     * Header description string.
     *
define ('PDF_HEADER_STRING', "by Nicola Asuni - Tecnick.com\nwww.tcpdf.org");

    /**
     * Document unit of measure [pt=point, mm=millimeter, cm=centimeter, in=inch].
     *
define ('PDF_UNIT', 'mm');

    /**
     * Header margin.
     *
define ('PDF_MARGIN_HEADER', 5);

    /**
     * Footer margin.
     *
define ('PDF_MARGIN_FOOTER', 10);

    /**
     * Top margin.
     *
define ('PDF_MARGIN_TOP', 27);

    /**
     * Bottom margin.
     *
define ('PDF_MARGIN_BOTTOM', 25);

    /**
     * Left margin.
     *
define ('PDF_MARGIN_LEFT', 15);

    /**
     * Right margin.
     *
define ('PDF_MARGIN_RIGHT', 15);

    /**
     * Default main font name.
     *
define ('PDF_FONT_NAME_MAIN', 'helvetica');

    /**
     * Default main font size.
     *
define ('PDF_FONT_SIZE_MAIN', 10);

    /**
     * Default data font name.
     *
define ('PDF_FONT_NAME_DATA', 'helvetica');

    /**
     * Default data font size.
     *
define ('PDF_FONT_SIZE_DATA', 8);

    /**
     * Default monospaced font name.
     *
define ('PDF_FONT_MONOSPACED', 'courier');

    /**
     * Ratio used to adjust the conversion of pixels to user units.
     *
define ('PDF_IMAGE_SCALE_RATIO', 1.25);

    /**
     * Magnification factor for titles.
     *
define('HEAD_MAGNIFICATION', 1.1);

    /**
     * Height of cell respect font height.
     *
define('K_CELL_HEIGHT_RATIO', 1.25);

    /**
     * Title magnification respect main font size.
     *
define('K_TITLE_MAGNIFICATION', 1.3);

    /**
     * Reduction factor for small font.
     *
define('K_SMALL_RATIO', 2/3);

    /**
     * Set to true to enable the special procedure used to avoid the overlappind of symbols on Thai language.
     *
define('K_THAI_TOPCHARS', true);

    /**
     * If true allows to call TCPDF methods using HTML syntax
     * IMPORTANT: For security reason, disable this feature if you are printing user HTML content.
     *
define('K_TCPDF_CALLS_IN_HTML', true);

    /**
     * If true and PHP version is greater than 5, then the Error() method throw new exception instead of terminating the execution.
     *
define('K_TCPDF_THROW_EXCEPTION_ERROR', false);
*/
//============================================================+
// END OF FILE
//============================================================+

    const PDF_FONT_NAME_MAIN= 'helvetica';
    const PDF_FONT_SIZE_MAIN = 10;
    const PDF_FONT_NAME_DATA = 'helvetica';
    const PDF_FONT_SIZE_DATA = 7;
    const PDF_FONT_MONOSPACED = 'courier';

    const PDF_MARGIN_TOP = 15;
    const PDF_MARGIN_BOTTOM = 15;
    const PDF_MARGIN_LEFT = 5;
    const PDF_MARGIN_RIGHT = 5;

    const PDF_MARGIN_HEADER = 5;
    const PDF_MARGIN_FOOTER = 5;

    const PDF_IMAGE_SCALE_RATIO = 1.25;

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
        $pdf->SetCreator(self::PDF_CREATOR);
        $pdf->SetAuthor('Olivier Bussier');
        $pdf->SetTitle("Facture - No : ". $factId);
        $pdf->SetSubject('Facture');
        $pdf->SetKeywords('Facture');

        // set default header data

        $pdf->SetHeaderData('logo.jpg', 80, $factId, $factId);

        // set header and footer fonts
        $pdf->setHeaderFont(Array(self::PDF_FONT_NAME_MAIN, '', 10));
        $pdf->setFooterFont(Array(self::PDF_FONT_NAME_DATA, '', 6));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(self::PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(5, 25, 5);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(self::PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, self::PDF_MARGIN_BOTTOM);

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
