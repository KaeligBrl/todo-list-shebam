<?php

namespace App\Repository;

use App\Entity\Quote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Quote|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quote|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quote[]    findAll()
 * @method Quote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quote::class);
    }
    
    // ** Quote **
    // Archived
    public function setQuoteForArchived($id)
    {
        $sql = "update App\Entity\Quote as t set t.archived = t where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

    // UnArchived
    public function setQuoteForUnArchived($id)
    {
        $sql = "update App\Entity\Quote as t set t.archived = 0 where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

    public function setQuoteArchivedBtn()
    {
        $sql = "update App\Entity\Quote as t set t.archived = 1";
        $query = $this->getEntityManager()->createQuery($sql);
        return $query->getResult();
    }

    public function setQuoteUnArchivedBtn()
    {
        $sql = "update App\Entity\Quote as t set t.archived = 0";
        $query = $this->getEntityManager()->createQuery($sql);
        return $query->getResult();
    }
}
