<?php

namespace App\Controller\Intranet;

use App\Entity\User;
use Doctrine\Common\Persistence;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class IntranetController extends AbstractController
{
    /**
     * @Route("/intranet/index", name="index_intranet")
     * @param ManagerRegistry $doctrine
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ManagerRegistry $doctrine)
    {
        $user = $this->getUser();
        $adh = $doctrine->getRepository(User::class)->find($user->getId());

        return $this->render('intranet/index.html.twig', [
            'adh' => $adh,
        ]);
    }
}
