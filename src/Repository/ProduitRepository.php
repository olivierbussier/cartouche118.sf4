<?php

namespace App\Repository;

use App\Entity\CategorieProduit;
use App\Entity\Fournisseur;
use App\Entity\Marque;
use App\Entity\Produit;
use App\Entity\RemisesClient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

    public function getSearchAjax($search)
    {
        $res = $this->createQueryBuilder('p')
            ->select('p,c,f,m,r')
            ->leftJoin('p.categorieProduit', 'c')
            ->leftJoin('p.fournisseur', 'f')
            ->leftJoin('p.marque', 'm')
            ->leftJoin('p.remisesClients', 'r')
            ->where("(p.nom like :s) or (p.code like :s) or ".
                "(p.caract1 like :s) or (p.caract2 like :s) or (p.caract3 like :s) or ".
                "(c.nom like :s) or (f.nom like :s) or".
                "(m.nom like :s) or (m.description like :s)"
            )
            ->setParameter('s', "%$search%")
            ->setMaxResults(20)
            ->getQuery()->getResult();

        return $res;
    }


//    /**
//     * @return Produit[] Returns an array of Produit objects
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
    public function findOneBySomeField($value): ?Produit
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
