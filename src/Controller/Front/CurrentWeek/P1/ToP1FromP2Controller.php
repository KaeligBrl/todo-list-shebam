<?php

namespace App\Controller\Front\CurrentWeek\P1;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ToP1FromP2Controller extends AbstractController
{

    /**
     * @Route("/semaine-actuelle/basculer/tache/p1-en-p2/{id}", name="change_task_cw_p1_to_p2")
     * return RedirectResponse
     */
    public function changeTaskToP2Front(Task $task, TaskRepository $taskRepository): Response
    {
        $taskRepository->setChangeTaskForP2CurrentWeek($task->getId());

        return $this->redirectToRoute("current_week_p1");
    }
}
