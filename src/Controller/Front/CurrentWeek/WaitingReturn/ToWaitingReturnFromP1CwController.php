<?php

namespace App\Controller\Front\CurrentWeek\WaitingReturn;

use App\Repository\WaitingReturnRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ToWaitingReturnFromP1CwController extends AbstractController
{

    /**
     * @Route("/semaine-actuelle/passer-waiting-return-vers-p1/{id}", name="to_waiting_return_from_p1_cw")
     */
    public function ToWaitingReturnFromP1Cw(WaitingReturnRepository $waitingReturnRepository, $id): Response
    {
        $waitingReturn = $waitingReturnRepository->find($id);

        if (!$waitingReturn) {
            throw $this->createNotFoundException('Attente retour non trouvée');
        }

        $task = $waitingReturnRepository->moveWaitingReturnToP1Cw($waitingReturn);

        return $this->redirectToRoute('current_week_waiting_return');
    }
}
