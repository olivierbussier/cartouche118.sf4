<?php

namespace App\Controller;

use App\Classes\Blog\BlogHelpers;
use App\Classes\Config\Config;
use App\Entity\Blog;
use App\Entity\BlogTypeChoice;
use App\Form\BlogEditType;
use App\Form\BlogTypeChoiceType;
use App\Repository\BlogRepository;
use DateTime;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class BlogController extends AbstractController
{
    /**
     * @Route("/intranet/admin_blog/index/{type}", name="blog_admin_index")
     * @param RegistryInterface $doctrine
     * @param Request $request
     * @param string $type
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(RegistryInterface $doctrine, Request $request, $type = BlogTypeChoice::PORTFOLIO)
    {
        /**
         * @var $blogsRepo BlogRepository
         */
        $blogsRepo = $doctrine->getRepository(Blog::class);

        $typeBlog = new BlogTypeChoice();

        $typeBlog->setType($type);

        $form = $this->createForm(BlogTypeChoiceType::class, $typeBlog);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $type = $typeBlog->getType();
            if ($type != '') {
                return $this->redirectToRoute('blog_admin_index',['type' => $type]);
            }
        }

        // Afficher les blogs

        $blogs     = $blogsRepo->getAllPosts($type);

        return $this->render('intranet/blog_index.html.twig',[
            'blogs' => $blogs,
            'type'  => $type,
            'form'  => $form->createView()
        ]);
    }

    /**
     * @Route("/intranet/admin_blog/delete/{blogId}", name="blog_admin_delete")
     * @param RegistryInterface $doctrine
     * @param string $blogId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete(RegistryInterface $doctrine, $blogId = '')
    {
        /**
         * @var $blogsRepo BlogRepository
         */
        $blogsRepo = $doctrine->getRepository(Blog::class);

        $blog = $blogsRepo->find($blogId);
        if ($blog) {

            if (!$blogsRepo->deleteById($blogId)) {
                throw $this->createNotFoundException(
                    "Blog non trouvé : ID = " . $blogId
                );
            }

            return $this->redirectToRoute('blog_admin_index', ['type' => $blog->getType()]);
        } else {
            return $this->redirectToRoute('blog_admin_index');
        }
    }

    /**
     * @Route("/intranet/admin_blog/up/{blogId}", name="blog_admin_up")
     * @param RegistryInterface $doctrine
     * @param int $blogId
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function up(RegistryInterface $doctrine, $blogId = 0)
    {
        if ($blogId == 0) {
            return $this->redirectToRoute("blog_admin_index");
        }
        /**
         * @var $blogsRepo BlogRepository
         */
        $blogsRepo = $doctrine->getRepository(Blog::class);

        $em = $this->getDoctrine()->getManager();

        /** @Var Bloc $blogSrc */
        $blogSrc = $blogsRepo->find($blogId);

        $positionSrc = $blogSrc->getPosition();

        $positionDest = $blogsRepo->selectPosJustBelow($blogSrc);

        $blogDest = $blogsRepo->selectByPosition($positionDest);

        $blogSrc->setPosition($positionDest);
        $blogDest->setPosition($positionSrc);
        $em->persist($blogDest);
        $em->persist($blogSrc);
        $em->flush();

        return $this->redirectToRoute('blog_admin_index', ['type' => $blogSrc->getType()]);
    }

    /**
     * @Route("/intranet/admin_blog/down/{blogId}", name="blog_admin_down")
     * @param RegistryInterface $doctrine
     * @param int $blogId
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function down(RegistryInterface $doctrine, $blogId = 0)
    {
        if ($blogId == 0) {
            return $this->redirectToRoute("blog_admin_index");
        }

        /**
         * @var $blogsRepo BlogRepository
         */
        $blogsRepo = $doctrine->getRepository(Blog::class);

        $em = $this->getDoctrine()->getManager();

        $blogSrc = $blogsRepo->find($blogId);
        $positionSrc = $blogSrc->getPosition();

        $positionDest = $blogsRepo->selectPosJustAbove($blogSrc);

        $blogDest = $blogsRepo->selectByPosition($positionDest);

        $blogSrc->setPosition($positionDest);
        $blogDest->setPosition($positionSrc);
        $em->persist($blogDest);
        $em->persist($blogSrc);
        $em->flush();

        return $this->redirectToRoute('blog_admin_index', ['type' => $blogSrc->getType()]);
    }

    /**
     * @Route("/intranet/admin_blog/new/{type}", name="blog_admin_create")
     * @Route("/intranet/admin_blog/edit/{blogId}", name="blog_admin_edit")
     * @param RegistryInterface $doctrine
     * @param Request $request
     * @param int $type
     * @param int $blogId
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function create(RegistryInterface $doctrine, Request $request, $type = 0, $blogId = 0)
    {
        /**
         * @var $blogsRepo BlogRepository
         */
        $blogsRepo = $doctrine->getRepository(Blog::class);
        $em = $this->getDoctrine()->getManager();

        $dirImages = Config::PATH_BLOG;

        if ($blogId == 0) {
            if ($type == 0) {
                return $this->redirectToRoute('blog_admin_index');
            }
            $blog = new Blog();
            $action = 'create';
            $blog->setType($type);
            //$em->persist($blog);
        } else {
            $blog = $blogsRepo->find($blogId);
            $action = 'edit';
        }

        $form = $this->createForm(BlogEditType::class, $blog);

        $form->handleRequest($request);

        $orient = '';
        $im = $blog->getImage();

        if ($form->isSubmitted() && $form->isValid()) {

            if ($action == 'create') {
                // Nouveau, remplir postedAt et Position

                // Set Position

                $pos = $blogsRepo->selectPosJustAbove();
                $blog->setPosition($pos + 1);

                // Set Date

                $blog->setPostedAt(new DateTime());
            }

            $fl = $blog->getFile();
            $type = $blog->getType();

            if ($fl != null) {

                $oldImage = null;

                if ($im != null) {
                    // Une image existe déjà et une nouvelle est choisie
                    // Mémorisation pour suppression
                    $oldImage = $im;
                }

                switch ($type) {
                    case BlogTypeChoice::CAROUSEL:
                        $largeur = 1900;
                        break;
                    case BlogTypeChoice::FEATURE:
                    case BlogTypeChoice::PORTFOLIO:
                    case BlogTypeChoice::MARKETING:
                        $largeur = 400;
                        break;
                    default:
                        $largeur = 400;
                        break;
                }
                /**
                 * @var UploadedFile $image
                 */
                $image = $form['file']->getData();

                $im = BlogHelpers::StorePhoto($image->getPathname(), $dirImages, $largeur);

                if ($oldImage) {
                    unlink("$dirImages/$oldImage");
                }
                $blog->setImage($im);
            }
            $em->persist($blog);
            $em->flush();

            return $this->redirectToRoute('blog_admin_index', ['type' => $type]);
        }

        return $this->render('intranet/blog_edit.html.twig',[
            'formBlogEdit' => $form->createView(),
            'orient' => $orient,
            'image'  => $im,
            'id'     => $blogId,
            'imblog' => $dirImages
        ]);
    }

    /**
     * @Route("intranet/admin_blog/delete_image/{blogId}", name="blog_admin_delete_image")
     * @param RegistryInterface $doctrine
     * @param int $blogId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteImage(RegistryInterface $doctrine, $blogId = 0)
    {
        if ($blogId == 0) {
            $this->redirectToRoute('root');
        }

        $conf = $this->getParameter('conf.blog');
        $dirImages = $conf['blog.images'];
        /**
         * @var $blogsRepo BlogRepository
         */
        $em = $this->getDoctrine()->getManager();
        $blogsRepo = $doctrine->getRepository(Blog::class);
        $blog = $blogsRepo->find($blogId);

        $image = $blog->getImage();

        if ($image) {
            // Une image existe
            unlink("$dirImages/$image");
            $blog->setImage(null);
            $em->persist($blog);
            $em->flush();
        }
        return $this->redirectToRoute("blog_admin_edit",['blogId' => $blogId]);
    }
}
