<?php

namespace App\Repository;

use App\Entity\CategorieProduit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategorieProduit|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieProduit|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieProduit[]    findAll()
 * @method CategorieProduit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieProduit::class);
    }

//    /**
//     * @return CategorieProduit[] Returns an array of CategorieProduit objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CategorieProduit
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
