<?php

namespace App\Repository;

use App\Entity\CreateInvoice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CreateInvoice>
 *
 * @method CreateInvoice|null find($id, $lockMode = null, $lockVersion = null)
 * @method CreateInvoice|null findOneBy(array $criteria, array $orderBy = null)
 * @method CreateInvoice[]    findAll()
 * @method CreateInvoice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CreateInvoiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CreateInvoice::class);
    }

    //    /**
    //     * @return CreateInvoice[] Returns an array of CreateInvoice objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?CreateInvoice
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
