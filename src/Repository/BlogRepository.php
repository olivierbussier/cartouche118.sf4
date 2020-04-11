<?php

namespace App\Repository;

use App\Entity\Blog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Blog|null find($id, $lockMode = null, $lockVersion = null)
 * @method Blog|null findOneBy(array $criteria, array $orderBy = null)
 * @method Blog[]    findAll()
 * @method Blog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogRepository extends ServiceEntityRepository
{
    /**
     * BlogRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Blog::class);
    }

    /**
     * @param $position
     * @return Blog|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function selectByPosition($position) : ?Blog
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.position = :val')
            ->setParameter('val', $position)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    /**
     * @param Blog $blog
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function selectPosJustBelow(Blog $blog)
    {
        $position = $blog->getPosition();

        $res = $this->createQueryBuilder('b')
            ->select('min(b.position)')
            ->where("b.position > $position")
            ->getQuery()
            ->getSingleResult()
            ;
        return $res[1];
    }

    /**
     * @param Blog $blog
     * @return int
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function selectPosJustAbove(Blog $blog = null)
    {
        if ($blog == null) {
            $position = 999999999;
        } else {
            $position = $blog->getPosition();
        }

        $res = $this->createQueryBuilder('b')
            ->select('max(b.position)')
            ->where("b.position < $position")
            ->getQuery()
            ->getSingleResult()
            ;
        return $res[1];
    }

    public function deleteById($id)
    {
        /**
         * @var $em EntityManager
         */
        $em = $this->getEntityManager();
        $blog = $this->find($id);

        if (!$blog) {
            return false;
        }
        $em->remove($blog);
        $em->flush();

        return true;
    }

    /**
     * @param string $type
     * @return Blog[] Returns an array of Blog objects
     */

    public function getAllPosts($type = 'services')
    {
        return $this->createQueryBuilder('b')
            ->where("b.type = '$type'")
            ->orderBy('b.position', 'desc')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * Select par type
     * @param string $type
     * @return Blog[] Returns an array of Blog objects
     */

    public function getPostsByType(string $type)
    {
        return $this->createQueryBuilder('b')
            ->where("b.type = '$type'")
            ->orderBy('b.position', 'desc')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }
}
