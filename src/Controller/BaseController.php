<?php

namespace App\Controller;

use App\Classes\Config\Config;
use App\Entity\Blog;
use App\Entity\BlogTypeChoice;
use App\Form\EcrireType;
use App\Repository\BlogRepository;
use Doctrine\Persistence\ManagerRegistry;
use Swift_Mailer;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{

    /**
     * @Route("/", name="root")
     * @param ManagerRegistry $doctrine
     * @return Response
     */
    public function index(ManagerRegistry $doctrine)
    {
        $repo = $doctrine->getRepository(Blog::class);
        /** @var BlogRepository $repo */
        $postsC  = $repo->getAllPosts(BlogTypeChoice::CAROUSEL);
        $postsS  = $repo->getAllPosts(BlogTypeChoice::SERVICES);
        $postsCl = $repo->getAllPosts(BlogTypeChoice::CLIENTS);
        $postsP  = $repo->getAllPosts(BlogTypeChoice::PRODUITS);

        $dirImages = Config::PATH_BLOG;

        return $this->render(
            'pages/index.html.twig',
            [
                'imblog' => $dirImages,
                'postCarousel'  => $postsC,
                'postServices'  => $postsS,
                'postClients'   => $postsCl,
                'postProduits'  => $postsP
            ]
        );
    }

    /**
     * @Route("/view_article/mkt/{blogId}", name="view_blog_mkt")
     * @param ManagerRegistry $doctrine
     * @param $blogId
     * @return Response
     */
    public function viewPost(ManagerRegistry $doctrine, $blogId)
    {
        $repo = $doctrine->getRepository(Blog::class);
        /** @var BlogRepository $repo */
        $post = $repo->find($blogId);

        return $this->render(
            'pages/view_mkt.html.twig',
            [
            'post'   => $post,
            'imblog' => Config::PATH_BLOG
            ]
        );
    }

    /**
     * @Route("/faq", name="index_faq")
     * @param ManagerRegistry $doctrine
     * @return Response
     */
    public function indexFAQ(ManagerRegistry $doctrine)
    {
        $repo = $doctrine->getRepository(Blog::class);
        /** @var BlogRepository $repo */
        $postsFAQ = $repo->getAllPosts(BlogTypeChoice::FAQ);

        $dirImages = Config::PATH_BLOG;

        return $this->render(
            'pages/faq.html.twig',
            [
            'imblog'  => $dirImages,
            'postFAQ' => $postsFAQ
            ]
        );
    }

    /**
     * @Route("/preview/{blogId}", name="root_preview")
     * @param ManagerRegistry $doctrine
     * @param string $blogId
     * @return Response
     */
    public function indexPreviewBlog(ManagerRegistry $doctrine, $blogId = '')
    {
        if ($blogId == '') {
            $this->redirectToRoute('root');
        }

        $post = $doctrine->getRepository(Blog::class)->find($blogId);

        $dirImages = Config::PATH_BLOG;

        return $this->render(
            'pages/index_preview.html.twig',
            [
            'post' => $post,
            'imblog' => $dirImages
            ]
        );
    }

    // Courses

    /**
     * @Route("/acces", name="acces")
     * @param Request $request
     * @param Swift_Mailer $mailer
     * @return RedirectResponse|Response
     */
    public function acces(Request $request, Swift_Mailer $mailer)
    {
        return $this->render('pages/index_acces.html.twig');
    }

    /**
     * @Route("/ecrire", name="ecrire")
     * @param Request $request
     * @param Swift_Mailer $mailer
     * @return RedirectResponse|Response
     */
    public function ecrire(Request $request, Swift_Mailer $mailer)
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

        return $this->render('pages/index_ecrire.html.twig', [
            'formContact' => $form->createView()
        ]);
    }
}
