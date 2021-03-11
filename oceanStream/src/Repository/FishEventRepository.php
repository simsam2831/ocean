<?php

namespace App\Repository;

use App\Entity\FishEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FishEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method FishEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method FishEvent[]    findAll()
 * @method FishEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FishEventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FishEvent::class);
    }

    // /**
    //  * @return FishEvent[] Returns an array of FishEvent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FishEvent
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
