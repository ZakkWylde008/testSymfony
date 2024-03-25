<?php

namespace App\Repository;

use App\Entity\EventAccount;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EventAccount>
 *
 * @method EventAccount|null find($id, $lockMode = null, $lockVersion = null)
 * @method EventAccount|null findOneBy(array $criteria, array $orderBy = null)
 * @method EventAccount[]    findAll()
 * @method EventAccount[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventAccountRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EventAccount::class);
    }

    //    /**
    //     * @return EventAccount[] Returns an array of EventAccount objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?EventAccount
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
