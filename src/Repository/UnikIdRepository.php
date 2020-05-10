<?php

namespace App\Repository;

use App\Entity\UnikId;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UnikId|null find($id, $lockMode = null, $lockVersion = null)
 * @method UnikId|null findOneBy(array $criteria, array $orderBy = null)
 * @method UnikId[]    findAll()
 * @method UnikId[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UnikIdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UnikId::class);
    }

    /**
     * @return void
     * @throws \Doctrine\DBAL\ConnectionException
     */
    public function getNewId()
    {
        $cnx = $this->getEntityManager()->getConnection();
        $cnx->beginTransaction();
        try {
            $this->createQueryBuilder('u')
                ->update(UnikId::class, 'u')
                ->set('u.reference', 'u.reference + 1')
                ->getQuery()
                ->execute();
            $res = $this->createQueryBuilder('u')
                ->select('u.reference')
                ->getQuery()
                ->getResult();
            $cnx->commit();
        } catch (\Exception $e) {
            $cnx->rollBack();
            throw $e;
        }
        return $res[0]['reference'];
    }

    /*
    public function findOneBySomeField($value): ?UnikId
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
