<?php

namespace App\Repository;

use App\Classes\Config\Config;
use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
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
     * @throws NonUniqueResultException
     * @throws NoResultException
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

        $qb->select('c,n,t,m')
            //->from('App\\Entity\\Client', 'c')
            ->leftJoin('c.notes', 'n')
            ->leftJoin('c.telephones', 't')
            ->leftJoin('c.emails', 'm')
            ->where("((c.nom like :term) or (c.prenom like :term) or (c.fullName like :term) or ".
                             "(n.text like :term) or (t.telephone like :term) or (m.email like :term) or ".
                             "m.email like :term)")
            ->andWhere("c.deleted = false")
            ->setParameter('term', "%$term%")
            ->OrderBy('c.fullName', 'ASC')
            ->addOrderBy('n.createdAt', 'desc')
            ->setFirstResult($pageNb * Config::NB_ITEM_PAR_PAGE)
            ->setMaxResults(Config::NB_ITEM_PAR_PAGE);

        $tmp = $qb->getDQL();
        return new Paginator($qb);
    }
}
