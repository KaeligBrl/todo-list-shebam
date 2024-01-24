<?php

namespace App\Controller\Front\NextWeek\WaitingReturn;

use App\Repository\WaitingReturnRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ToWaitingReturnFromP1NwController extends AbstractController
{
    /**
     * @Route("/semaine-suivante/passer-attente-retour-vers-p1/{id}", name="to_waiting_return_from_p1_nw")
     */
    public function ToWaitingReturnFromP1Nw(WaitingReturnRepository $waitingReturnRepository, $id): Response
    {
        $waitingReturn = $waitingReturnRepository->find($id);

        if (!$waitingReturn) {
            throw $this->createNotFoundException('Attente retour non trouvée');
        }

        $task = $waitingReturnRepository->moveWaitingReturnToP1Nw($waitingReturn);

        return $this->redirectToRoute('next_week_waiting_return');
    }
}
