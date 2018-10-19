<?php

namespace App\Controller\Intranet;

use App\Classes\Sheets\Sheets;
use App\Entity\Adherent;
use App\Entity\User;
use App\Repository\AdherentRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IntranetController extends Controller
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
