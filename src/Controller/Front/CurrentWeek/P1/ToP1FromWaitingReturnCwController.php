<?php

namespace App\Controller\Front\CurrentWeek\P1;

use App\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ToP1FromWaitingReturnCwController extends AbstractController
{

    /**
     * @Route("/semaine-acutelle/passer-p1-vers-attente-retour/{id}", name="to_p1_from_waiting_return_cw")
     */
    public function passerP1VersWaitingReturn(TaskRepository $taskRepository, $id): Response
    {
        $task = $taskRepository->find($id);

        if (!$task) {
            throw $this->createNotFoundException('Tâche non trouvée');
        }

        $waitingReturn = $taskRepository->moveP1ToWaitingReturnCw($task);

        return $this->redirectToRoute('current_week_p1');
    }
}
