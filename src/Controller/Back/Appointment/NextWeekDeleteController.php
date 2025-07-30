<?php

namespace App\Controller\Back\Appointment;

use App\Entity\Appointment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NextWeekDeleteController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    #[Route('/semaine-suivante/rendez-vous/supprimer/id={id}', name: 'delete_appointment_nw_back')]
    public function deleteQuoteNextWeek(Appointment $appointmentDelete): RedirectResponse
    {
        $this->entityManager->remove($appointmentDelete);
        $this->entityManager->flush();

        return $this->redirectToRoute("next_week");
    }

}
