<?php

namespace App\Repository;

use App\Entity\IdeaBam;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IdeaBam|null find($id, $lockMode = null, $lockVersion = null)
 * @method IdeaBam|null findOneBy(array $criteria, array $orderBy = null)
 * @method IdeaBam[]    findAll()
 * @method IdeaBam[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IdeaBamRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IdeaBam::class);
    }

    public function findIdeabamByWaitingReturnTrue()
    {
        return $this->createQueryBuilder('i')
        ->leftJoin('i.person', 'p')
        ->addSelect('p')
        ->where('i.waitingReturn IS NULL')
        ->orderBy('p.firstname', 'ASC')
        ->getQuery()
        ->getResult();
    }

    public function findIdeabamByWaitingReturnFalse()
    {
        return $this->createQueryBuilder('i')
            ->leftJoin('i.person', 'p')
            ->addSelect('p')
            ->where('i.waitingReturn IS NOT NULL')
            ->orderBy('p.firstname', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function setChangeIdeabamIdeabamWaitingReturn($id)
    {
        $sql = "update App\Entity\IdeaBam as t set t.waitingReturn = 1 where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

    public function setChangeIdeabamWaitingReturnToIdeabam($id)
    {
        $sql = "update App\Entity\IdeaBam as t set t.waitingReturn = NULL where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

}
