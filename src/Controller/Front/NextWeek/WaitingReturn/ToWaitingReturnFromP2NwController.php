<?php

namespace App\Controller\Front\NextWeek\WaitingReturn;

use App\Repository\WaitingReturnRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ToWaitingReturnFromP2NwController extends AbstractController
{
    /**
     * @Route("/semaine-suivante/passer-attente-retour-vers-p2/{id}", name="to_waiting_return_from_p2_nw")
     */
    public function ToWaitingReturnFromP2Nw(WaitingReturnRepository $waitingReturnRepository, $id): Response
    {
        $waitingReturn = $waitingReturnRepository->find($id);

        if (!$waitingReturn) {
            throw $this->createNotFoundException('Attente retour non trouvée');
        }

        $task = $waitingReturnRepository->moveWaitingReturnToP2Nw($waitingReturn);

        return $this->redirectToRoute('next_week_waiting_return');
    }
}
