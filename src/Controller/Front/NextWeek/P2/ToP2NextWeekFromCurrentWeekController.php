<?php

namespace App\Controller\Front\NextWeek\P2;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ToP2NextWeekFromCurrentWeekController extends AbstractController
{
    /**
     * @Route("/semaine-suivante/basculer/p2/semaine-actuelle/{id}", name="change_task_p2_nw_to_p2_cw")
     * return RedirectResponse
     */
    public function changeTaskP2CurrentWeekToP2NextWeek(Task $task, TaskRepository $taskRepository): Response
    {
        $taskRepository->setChangeTaskP2NextWeekToP2CurrentWeek($task->getId());

        return $this->redirectToRoute("next_week_p2");
    }

}
