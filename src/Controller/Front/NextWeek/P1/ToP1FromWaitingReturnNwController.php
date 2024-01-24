<?php

namespace App\Controller\Front\NextWeek\P1;

use App\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ToP1FromWaitingReturnNwController extends AbstractController
{

    /**
     * @Route("/semaine-suivante/passer-p1-vers-attente-retour/{id}", name="to_p1_from_waiting_return_nw")
     */
    public function passerP1VersWaitingReturnNw(TaskRepository $taskRepository, $id): Response
    {
        $task = $taskRepository->find($id);

        if (!$task) {
            throw $this->createNotFoundException('Tâche non trouvée');
        }

        $waitingReturn = $taskRepository->moveP1ToWaitingReturnNw($task);

        return $this->redirectToRoute('next_week_p1');
    }
}
