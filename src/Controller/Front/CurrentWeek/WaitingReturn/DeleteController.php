<?php

namespace App\Controller\Front\CurrentWeek\WaitingReturn;

use App\Entity\WaitingReturn;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteController extends AbstractController
{
    /**
     * @Route("/semaine-actuelle/attente-retour/supprimer/{id}", name="current_week_delete_waiting_return")
     */
    public function deleteTask(WaitingReturn $waitingReturn, EntityManagerInterface $entityManager): RedirectResponse
    {
        $entityManager->remove($waitingReturn);
        $entityManager->flush();

        return $this->redirectToRoute("current_week_waiting_return");
    }
}