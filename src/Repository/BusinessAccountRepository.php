<?php

namespace App\Repository;

use App\Entity\BusinessAccount;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BusinessAccount>
 *
 * @method BusinessAccount|null find($id, $lockMode = null, $lockVersion = null)
 * @method BusinessAccount|null findOneBy(array $criteria, array $orderBy = null)
 * @method BusinessAccount[]    findAll()
 * @method BusinessAccount[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BusinessAccountRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BusinessAccount::class);
    }

    //    /**
    //     * @return BusinessAccount[] Returns an array of BusinessAccount objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?BusinessAccount
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
