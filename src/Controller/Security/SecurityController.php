<?php

namespace App\Controller\Security;

use App\Classes\Form\FormConst;
use App\Entity\Adherent;
use App\Entity\Role;
use App\Entity\Roles;
use App\Entity\User;
use App\Form\RegistrationType;
use DateTime;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends Controller
{
    /**
     * @Route("/registration", name="registration")
     * @param Request $request
     * @param ObjectManager $manager
     * @param UserPasswordEncoderInterface $encoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function Registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);

            $role = new Roles();
            $role->setRole('ROLE_USER');
            $user->addRole($role);
            $manager->persist($role);
            $role = new Roles();
            $role->setRole('ROLE_PUB');
            $user->addRole($role);
            $manager->persist($role);

            $manager->flush();

            return $this->redirectToRoute('connexion');
        }

        return $this->render('intranet/registration.html.twig', [
            'formInscr' => $form->createView()
        ]);
    }

    /**
     * @Route("/connexion", name="connexion")
     * @param Request $request
     * @param AuthenticationUtils $authenticationUtils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastuser = $authenticationUtils->getLastUsername();

        return $this->render('intranet/login.html.twig', [
            'error'     => $error,
            'lastUser'  => $lastuser
        ]);
    }

    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function logout()
    {
    }
}
