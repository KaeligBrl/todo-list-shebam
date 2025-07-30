<?php

namespace App\Controller\Back\Appointment;

use App\Entity\Appointment;
use App\Repository\AppointmentRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class ToNextWeekController extends AbstractController
{
    /**
     * @Route("/semaine-actuelle/basculer/rendez-vous/semaine-suivante/{id}", name="change_appointment_cw_to_nw_back")
     * return RedirectResponse
     */
    public function changeQuoteCurrentToNextWeek(AppointmentRepository $appointmentRepository, Appointment $appointment): Response
    {
        $entityManager = $entityManager;
        $repository = $entityManager->$appointmentRepository;

        $repository->changeAppointmentCurrentWeekToNextWeek($appointment->getId());

        return $this->redirectToRoute("next_week");
    }

}
