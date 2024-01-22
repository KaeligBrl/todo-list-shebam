<?php

namespace App\Controller\Front\NextWeek\P1;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ToNextWeekFromCurrentWeekController extends AbstractController
{

    /**
     * @Route("/semaine-suivante/basculer/tache/p1/semaine-actuelle/{id}", name="change_task_p1_nw_to_p1_cw")
     * return RedirectResponse
     */
    public function ChangeTaskP1NextWeekToP1CurrentWeek(Task$task, TaskRepository $taskRepository): Response
    {
        $taskRepository->setChangeTaskP1NextWeekToP1CurrentWeek($task->getId());

        return $this->redirectToRoute("next_week_p1");
    }

}
