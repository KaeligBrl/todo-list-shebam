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

    public function setChangeWaitingReturnCurrentWeekToWaitingReturnNextWeek($id)
    {
        $sql = "update App\Entity\WaitingReturn as t set t.nextweek = 1 where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

    public function setChangeWaitingReturnNextWeekToWaitingReturnCurrentWeek($id)
    {
        $sql = "update App\Entity\WaitingReturn as t set t.nextweek = 0 where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }
}
