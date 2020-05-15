<?php

namespace App\Repository;

use App\Entity\CustomerMeasure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CustomerMeasure|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerMeasure|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerMeasure[]    findAll()
 * @method CustomerMeasure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerMeasureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerMeasure::class);
    }

    // /**
    //  * @return CustomerMeasure[] Returns an array of CustomerMeasure objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CustomerMeasure
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
