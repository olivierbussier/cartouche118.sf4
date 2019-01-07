<?php

namespace App\Controller\Intranet;

use App\Entity\User;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class IntranetController extends AbstractController
{
    /**
     * @Route("/intranet/index", name="index_intranet")
     * @param RegistryInterface $doctrine
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(RegistryInterface $doctrine)
    {
        $user = $this->getUser();
        $adh = $doctrine->getRepository(User::class)->find($user->getId());

        return $this->render('intranet/index.html.twig', [
            'adh' => $adh,
        ]);
    }
}
