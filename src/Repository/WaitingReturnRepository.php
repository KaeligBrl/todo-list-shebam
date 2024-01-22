<?php

namespace App\Repository;

use App\Entity\WaitingReturn;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WaitingReturn|null find($id, $lockMode = null, $lockVersion = null)
 * @method WaitingReturn|null findOneBy(array $criteria, array $orderBy = null)
 * @method WaitingReturn[]    findAll()
 * @method WaitingReturn[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WaitingReturnRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WaitingReturn::class);
    }
}
