<?php

namespace App\Repository;

use App\Entity\Task;
use App\Entity\WaitingReturn;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findAll()
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }
    // ** Priority 1 **
    // Archived
    public function setTaskForArchived($id)
    {
        $sql = "update App\Entity\Task as t set t.archived = 1 where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

    // UnArchived
    public function setTaskForUnArchived($id)
    {
        $sql = "update App\Entity\Task as t set t.archived = 0 where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

    public function setTaskArchivedBtn()
    {
        $sql = "update App\Entity\Task as t set t.archived = 1";
        $query = $this->getEntityManager()->createQuery($sql);
        return $query->getResult();
    }

    public function setTaskUnArchivedBtn()
    {
        $sql = "update App\Entity\Task as t set t.archived = 0";
        $query = $this->getEntityManager()->createQuery($sql);
        return $query->getResult();
    }

    public function setChangeTaskForP1CurrentWeek($id)
    {
        $sql = "update App\Entity\Task as t set t.p1 = 1, t.p2 = 0 where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

    public function setChangeTaskForP1NextWeek($id)
    {
        $sql = "update App\Entity\Task as t set t.p1 = 1, t.p2 = 0, t.nextweek = 1 where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

    public function setChangeTaskForP2NextWeek($id)
    {
        $sql = "update App\Entity\Task as t set t.p1 = 0, t.p2 = 1, t.nextweek = 1 where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

    public function setChangeTaskForP2CurrentWeek($id)
    {
        $sql = "update App\Entity\Task as t set t.p2 = 1 , t.p1 = 0 where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

    public function setChangeTaskP1NextWeekToP1CurrentWeek($id)
    {
        $sql = "update App\Entity\Task as t set t.p1 = 1 , t.p2 = 0, t.nextweek = 0 where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

    public function setChangeTaskP2NextWeekToP2CurrentWeek($id)
    {
        $sql = "update App\Entity\Task as t set t.p1 = 0 , t.p2 = 1, t.nextweek = 0 where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

    public function setChangeTaskP1CurrentWeekToP1NextWeek($id)
    {
        $sql = "update App\Entity\Task as t set t.p1 = 1 , t.p2 = 0, t.nextweek = 1 where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

    public function setChangeTaskP2CurrentWeekToP2NextWeek($id)
    {
        $sql = "update App\Entity\Task as t set t.p1 = 0 , t.p2 = 2, t.nextweek = 1 where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

    public function setRemoveTask()
    {
        $sql = "delete from App\Entity\Task as t where t.nextweek = 0 or t.done = 1";
        $query = $this->getEntityManager()->createQuery($sql);
        return $query->getResult();
    }

    public function setChangeTaskToCurrentWeek()
    {
        $sql = "update App\Entity\Task as t set t.nextweek = 0 ";
        $query = $this->getEntityManager()->createQuery($sql);
        return $query->getResult();
    }

    public function moveP1ToWaitingReturnCw(Task $task)
    {
        // Créez une nouvelle instance de WaitingReturn
        $waitingReturn = new WaitingReturn();
        $waitingReturn->setObject($task->getObject());
        $waitingReturn->setSubObject1($task->getSubObject1());
        $waitingReturn->setSubObject2($task->getSubObject2());
        $waitingReturn->setSubObject3($task->getSubObject3());

        // Pour une relation ManyToMany, vous devez ajouter chaque utilisateur un par un
        foreach ($task->getUsers() as $user) {
            $waitingReturn->addUser($user);
        }

        $waitingReturn->setCustomer($task->getCustomer());
        $waitingReturn->setNextweek(false);

        // Supprimez la tâche de la base de données
        $this->_em->remove($task);

        // Enregistrez les changements dans la base de données
        $this->_em->persist($waitingReturn);
        $this->_em->flush();

        return $waitingReturn;
    }

    public function moveP1ToWaitingReturnNw(Task $task)
    {
        // Créez une nouvelle instance de WaitingReturn
        $waitingReturn = new WaitingReturn();
        $waitingReturn->setObject($task->getObject());
        $waitingReturn->setSubObject1($task->getSubObject1());
        $waitingReturn->setSubObject2($task->getSubObject2());
        $waitingReturn->setSubObject3($task->getSubObject3());

        // Pour une relation ManyToMany, vous devez ajouter chaque utilisateur un par un
        foreach ($task->getUsers() as $user) {
            $waitingReturn->addUser($user);
        }

        $waitingReturn->setCustomer($task->getCustomer());
        $waitingReturn->setNextweek(true);

        // Supprimez la tâche de la base de données
        $this->_em->remove($task);

        // Enregistrez les changements dans la base de données
        $this->_em->persist($waitingReturn);
        $this->_em->flush();

        return $waitingReturn;
    }
}
