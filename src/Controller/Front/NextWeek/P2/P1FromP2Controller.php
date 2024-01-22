<?php

namespace App\Controller\Front\NextWeek\P2;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class P1FromP2Controller extends AbstractController
{
    /**
     * @Route("/semaine-suivante/basculer/p2-en-p1/{id}", name="change_task_nw_to_p1")
     * return RedirectResponse
     */
    public function changeTaskToP1Front(Task $task, TaskRepository $taskRepository): Response
    {
        $taskRepository->setChangeTaskForP1CurrentWeek($task->getId());

        return $this->redirectToRoute("next_week_p2");
    }

}
