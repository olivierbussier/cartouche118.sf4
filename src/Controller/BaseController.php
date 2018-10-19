<?php

namespace App\Controller;

use App\Classes\Config\Config;
use App\Entity\Blog;
use App\Form\EcrireType;
use Swift_Mailer;
use Swift_Message;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{

    /**
     * @Route("/", name="root")
     * @param RegistryInterface $doctrine
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(RegistryInterface $doctrine)
    {
        $posts = $doctrine->getRepository(Blog::class)->getAllPosts();

        $dirImages = Config::PATH_BLOG;

        // affichage de toutes les images du rep pub

        $pubs = glob('public/imp/*.*');

        return $this->render(
            'pages/index.html.twig', [
                'imblog' => $dirImages,
                'posts' => $posts
        ]);
    }
    /**
     * @Route("/preview/{blogId}", name="root_preview")
     * @param RegistryInterface $doctrine
     * @param string $blogId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexPreviewBlog(RegistryInterface $doctrine, $blogId = '')
    {
        if ($blogId == '') {
            $this->redirectToRoute('root');
        }

        $post = $doctrine->getRepository(Blog::class)->find($blogId);

        $dirImages = Config::PATH_BLOG;

        return $this->render(
            'pages/index_preview.html.twig', [
            'post' => $post,
            'imblog' => $dirImages
        ]);
    }

    // Courses

    /**
     * @Route("/contact", name="index_contact")
     * @param Request $request
     * @param Swift_Mailer $mailer
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function contact(Request $request,Swift_Mailer $mailer)
    {
        $form = $this->createForm(EcrireType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $contactFormData = $form->getData();
            $message = (new Swift_Message('Mail de contact site Cartouche 118'))
                ->setFrom($contactFormData['from'])
                ->setTo('contact@cartouche118.fr')
                ->setBody(
                    $contactFormData['message'],
                    'text/plain'
                    )
            ;

            $res = $mailer->send($message);
            if ($res == false) {
                $this->addFlash('danger', "Votre message n'a pas pu être envoyé");
            } else {
                $this->addFlash('info', 'Message envoyé');
                return $this->redirect($request->getUri());
            }
        }

        return $this->render('pages/index_contact.html.twig',[
            'formContact' => $form->createView()
        ]);
    }
}
