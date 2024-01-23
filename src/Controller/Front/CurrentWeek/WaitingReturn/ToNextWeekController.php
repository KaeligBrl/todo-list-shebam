<?php

namespace App\Controller\Front\CurrentWeek\WaitingReturn;

use App\Entity\WaitingReturn;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\WaitingReturnRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ToNextWeekController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/semaine-actuelle/basculer/attente-retour/semaine-suivante/{id}", name="change_waiting_return_to_waiting_return_nw")
     * return RedirectResponse
     */
    public function changeWaitingReturnCurrentWeekToWaitingReturnNextWeek(WaitingReturn $waitingReturn, WaitingReturnRepository $waitingReturnRepository): Response
    {
        $waitingReturnRepository->setChangeWaitingReturnCurrentWeekToWaitingReturnNextWeek($waitingReturn->getId());

        return $this->redirectToRoute("current_week_waiting_return");
    }
}
