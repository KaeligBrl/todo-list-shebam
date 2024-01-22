<?php

namespace App\Controller\Front\CurrentWeek\P2;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ToP2FromP1Controller extends AbstractController
{

    /**
     * @Route("/semaine-actuelle/basculer/p2-en-p1/{id}", name="change_task_cw_to_p1")
     * return RedirectResponse
     */
    public function changeTaskToP1Front(Task $task, TaskRepository $taskRepository): Response
    {
        $taskRepository->setChangeTaskForP1CurrentWeek($task->getId());

        return $this->redirectToRoute("current_week_p2");
    }
}
