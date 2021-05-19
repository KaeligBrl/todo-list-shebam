<?php

namespace App\Repository;

use App\Entity\Task2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Task2|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task2|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task2[]    findAll()
 * @method Task2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Task2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task2::class);
    }

    //Count number of Task
    public function countTask2(){
        return $this->createQueryBuilder('d')
        ->select('count(d.task2) as count')
        ->getQuery()
        ->getSingleScalarResult();
    }

    // /**
    //  * @return Task2[] Returns an array of Task2 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Task2
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
