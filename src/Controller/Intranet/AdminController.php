<?php

namespace App\Controller\Intranet;

use App\Entity\User;
use App\Form\EditUserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminController extends AbstractController
{
    /**
     * @Route("/intranet/listusers", name="listusers")
     * @param UserRepository $user
     * @return Response
     */
    public function adminusers(UserRepository $user)
    {
        return $this->render('intranet/admin/listusers.html.twig', [
            'users' => $user->findAll()
        ]);
    }

    /**
     * @Route("/intranet/edituser/{userId}", name="edituser")
     * @param UserPasswordEncoderInterface $ei
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param int $userId
     * @return Response
     */
    public function edituser(UserPasswordEncoderInterface $ei, EntityManagerInterface $em, Request $request, $userId = 0)
    {
        if ($userId == 0) {
            $user = new User();
        } else {
            $user = $em->find(User::class, $userId);
        }

        $encoded = $ei->encodePassword($user, "621960");
        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('message', 'Utilisateur modifié avec succès');
            return $this->redirectToRoute('listusers');
        }

        return $this->render('Intranet/admin/edituser.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }
}
