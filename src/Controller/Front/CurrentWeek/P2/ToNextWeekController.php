<?php

namespace App\Controller\Front\CurrentWeek\P2;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ToNextWeekController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/semaine-actuelle/basculer/p2/semaine-suivante/{id}", name="change_task_p2_cw_to_p2_nw")
     * return RedirectResponse
     */
    public function changeTaskP1CurrentWeekToP1NextWeek(Task $task, TaskRepository $taskRepository): Response
    {
        $taskRepository->setChangeTaskP2CurrentWeekToP2NextWeek($task->getId());

        return $this->redirectToRoute("current_week_p2");
    }
}
