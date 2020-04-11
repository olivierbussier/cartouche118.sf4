<?php

namespace App\Repository;

use App\Classes\Config\Config;
use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Client|null find($id, $lockMode = null, $lockVersion = null)
 * @method Client|null findOneBy(array $criteria, array $orderBy = null)
 * @method Client[]    findAll()
 * @method Client[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    /**
     * @param string $where
     * @return Client[] Returns an array of Client objects
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countEntity($where = '1')
    {
        return $this->createQueryBuilder('entity')
            ->select('count(entity)')
           // ->andWhere($where)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    public function getFilterAndPagination($term, $pageNb)
    {
        $qb = $this->createQueryBuilder('c');

        $qb->select('c')
            //->from('App\\Entity\\Client', 'c')
            ->leftJoin(
                'c.notes', 'n')
            ->where("c.nom like :term")
            ->orWhere('c.prenom like :term')
            ->orWhere('c.fullName like :term')
            ->orWhere('n.text like :term')
            ->setParameter('term', "%$term%")
            ->setFirstResult($pageNb * Config::NB_ITEM_PAR_PAGE)
            ->setMaxResults(Config::NB_ITEM_PAR_PAGE);

        return new Paginator($qb);
    }
    /*
    public function findOneBySomeField($value): ?Client
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
