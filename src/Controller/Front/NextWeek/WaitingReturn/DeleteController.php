<?php

namespace App\Controller\Front\NextWeek\WaitingReturn;

use App\Entity\WaitingReturn;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteController extends AbstractController
{
    /**
     * @Route("/semaine-suivante/attente-retour/supprimer/{id}", name="next_week_delete_waiting_return")
     */
    public function deleteWaitingReturn(WaitingReturn $waitingReturn, EntityManagerInterface $entityManager): RedirectResponse
    {
        $entityManager->remove($waitingReturn);
        $entityManager->flush();

        return $this->redirectToRoute("next_week_waiting_return");
    }
}