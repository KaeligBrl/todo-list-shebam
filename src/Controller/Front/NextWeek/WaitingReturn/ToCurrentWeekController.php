<?php

namespace App\Controller\Front\NextWeek\WaitingReturn;

use App\Entity\WaitingReturn;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\WaitingReturnRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ToCurrentWeekController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/semaine-suivante/basculer/attente-retour/semaine-actuelle/{id}", name="change_waiting_return_to_waiting_return_cw")
     * return RedirectResponse
     */
    public function changeWaitingReturnNextWeekWeekToWaitingReturnCurrentWeek(WaitingReturn $waitingReturn, WaitingReturnRepository $waitingReturnRepository): Response
    {
        $waitingReturnRepository->setChangeWaitingReturnNextWeekToWaitingReturnCurrentWeek($waitingReturn->getId());

        return $this->redirectToRoute("next_week_waiting_return");
    }
}
