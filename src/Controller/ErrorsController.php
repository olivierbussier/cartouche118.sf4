<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ErrorsController extends AbstractController
{

    /**
     * @Route("/access_denied", name="acces_denied")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function accessDenied(Request $request)
    {
        return $this->render(
            'errors/access_denied.html.twig',
            [
                'request' => $request,
                'msg' => "L'accès à cette pasge n'est pas autorisé avec les droits que vous possédez"
            ]
        );
    }
}
