<?php

namespace App\Controller\Front\CurrentWeek\WaitingReturn;

use App\Repository\WaitingReturnRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ToWaitingReturnFromP2CwController extends AbstractController
{

    /**
     * @Route("/semaine-actuelle/passer-waiting-return-vers-p2/{id}", name="to_waiting_return_from_p2_cw")
     */
    public function ToWaitingReturnFromP2Cw(WaitingReturnRepository $waitingReturnRepository, $id): Response
    {
        $waitingReturn = $waitingReturnRepository->find($id);

        if (!$waitingReturn) {
            throw $this->createNotFoundException('Attente retour non trouvée');
        }

        $task = $waitingReturnRepository->moveWaitingReturnToP2Cw($waitingReturn);

        return $this->redirectToRoute('current_week_waiting_return');
    }
}
