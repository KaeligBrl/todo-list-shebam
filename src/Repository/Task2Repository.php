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

    // ** Priority 2 **
    // Archived
    public function setTask2ForArchived($id)
    {
        $sql = "update App\Entity\Task2 as t set t.archived = t where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

    // UnArchived
    public function setTask2ForUnArchived($id)
    {
        $sql = "update App\Entity\Task2 as t set t.archived = 0 where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }
}
