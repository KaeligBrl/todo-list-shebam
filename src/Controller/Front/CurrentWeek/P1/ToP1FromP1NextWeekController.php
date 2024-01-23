<?php

namespace App\Controller\Front\CurrentWeek\P1;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ToP1FromP1NextWeekController extends AbstractController
{
    /**
     * @Route("/semaine-actuelle/basculer/p1/semaine-suivante/{id}", name="change_task_p1_cw_to_p1_nw")
     * return RedirectResponse
     */
    public function changeTaskToP2Front(Task $task, TaskRepository $taskRepository): Response
    {
        $taskRepository->setChangeTaskForP1NextWeek($task->getId());

        return $this->redirectToRoute("current_week_p1");
    }
}
