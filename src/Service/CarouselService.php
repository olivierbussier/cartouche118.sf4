<?php

namespace App\Service;

use App\Entity\Blog;
use App\Entity\BlogTypeChoice;
use App\Repository\BlogRepository;
use Doctrine\Common\Persistence;
use Doctrine\Persistence\ManagerRegistry;

class CarouselService
{

    private $blogs;

    public function __construct(ManagerRegistry $doctrine)
    {

        /**
         * @var $blogsRepo BlogRepository
         */
        $blogsRepo   = $doctrine->getRepository(Blog::class);
        $this->blogs = $blogsRepo->getAllPosts(BlogTypeChoice::CAROUSEL);
    }

    /**
     * @return Blog[]
     */
    public function getBlogs(): array
    {
        return $this->blogs;
    }

    /**
     * @param Blog[] $blogs
     */
    public function setBlogs(array $blogs): void
    {
        $this->blogs = $blogs;
    }
}
