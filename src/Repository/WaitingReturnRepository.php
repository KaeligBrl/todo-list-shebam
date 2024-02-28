<?php

namespace App\Repository;

use App\Entity\Task;
use App\Entity\WaitingReturn;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

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

    public function moveWaitingReturnToP1Cw(WaitingReturn $waitingReturn)
    {

        $task = new Task();
        $task->setObject($waitingReturn->getObject());
        $task->setSubObject1($waitingReturn->getSubObject1());
        $task->setSubObject2($waitingReturn->getSubObject2());
        $task->setSubObject3($waitingReturn->getSubObject3());

        foreach ($waitingReturn->getUsers() as $user) {
            $task->addUser($user);
        }

        $task->setCustomer($waitingReturn->getCustomer());
        $task->setNextweek(false);
        $task->setP1(true);

        $this->_em->remove($waitingReturn);
        $this->_em->persist($task);
        $this->_em->flush();

        return $task;
    }

    public function moveWaitingReturnToP2Cw(WaitingReturn $waitingReturn)
    {

        $task = new Task();
        $task->setObject($waitingReturn->getObject());
        $task->setSubObject1($waitingReturn->getSubObject1());
        $task->setSubObject2($waitingReturn->getSubObject2());
        $task->setSubObject3($waitingReturn->getSubObject3());

        foreach ($waitingReturn->getUsers() as $user) {
            $task->addUser($user);
        }

        $task->setCustomer($waitingReturn->getCustomer());
        $task->setNextweek(false);
        $task->setP2(true);

        $this->_em->remove($waitingReturn);
        $this->_em->persist($task);
        $this->_em->flush();

        return $task;
    }

    public function moveWaitingReturnToP1Nw(WaitingReturn $waitingReturn)
    {

        $task = new Task();
        $task->setObject($waitingReturn->getObject());
        $task->setSubObject1($waitingReturn->getSubObject1());
        $task->setSubObject2($waitingReturn->getSubObject2());
        $task->setSubObject3($waitingReturn->getSubObject3());

        foreach ($waitingReturn->getUsers() as $user) {
            $task->addUser($user);
        }

        $task->setCustomer($waitingReturn->getCustomer());
        $task->setNextweek(true);
        $task->setP1(true);

        $this->_em->remove($waitingReturn);
        $this->_em->persist($task);
        $this->_em->flush();

        return $task;
    }
}
