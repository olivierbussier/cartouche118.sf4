<?php

namespace App\Controller\Intranet;

use App\Entity\User;
use App\Form\EditUserType;
use App\Form\RegistrationType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminController extends AbstractController
{
    /**
     * @Route("/intranet/admin/newuser", name="newuser")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param UserPasswordEncoderInterface $encoder
     * @return RedirectResponse|Response
     */
    public function newuser(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);

            //$em->flush();

            return $this->redirectToRoute('adminusers');
        }

        return $this->render('intranet/admin/newuser.html.twig', [
            'formInscr' => $form->createView()
        ]);
    }

    /**
     * @Route("/intranet/admin/adminusers", name="adminusers")
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
     * @Route("/intranet/admin/edituser/{userId}", name="edituser")
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

        $user->
        //$encoded = $ei->encodePassword($user, "621960");
        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Vérif du mot de passe demandé

            $p1 = $user->getPassword();
            $p2 = $user->getConfirmPassword();

            if (strlen($p1) >= 8 && $p1 == $p2) {
                // Accept
                $pass = $ei->encodePassword($user, $p1);
            }
            $em->persist($user);
            $em->flush();

            $this->addFlash('message', 'Utilisateur modifié avec succès');
            return $this->redirectToRoute('adminusers');
        }

        return $this->render('Intranet/admin/edituser.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }
}
