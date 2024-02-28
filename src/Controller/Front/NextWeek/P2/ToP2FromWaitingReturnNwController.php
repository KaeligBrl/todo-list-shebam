<?php

namespace App\Controller\Front\NextWeek\P2;

use App\Repository\TaskRepository;
use App\Repository\WaitingReturnRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ToP2FromWaitingReturnNwController extends AbstractController
{
    /**
     * @Route("/semaine-suivante/passer-p2-vers-attente-retour/{id}", name="to_p2_from_waiting_return_nw")
     */
    public function passerP2VersWaitingReturn(TaskRepository $taskRepository, $id): Response
    {
        $task = $taskRepository->find($id);

        if (!$task) {
            throw $this->createNotFoundException('Tâche non trouvée');
        }

        $waitingReturn = $taskRepository->moveTaskToWaitingReturnNw($task);

        return $this->redirectToRoute('next_week_p2');
    }
}
