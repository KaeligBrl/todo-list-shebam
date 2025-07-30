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
    #[Route('/semaine-actuelle/basculer/rendez-vous/semaine-suivante/{id}', name: 'change_appointment_cw_to_nw_back')]
    public function changeQuoteCurrentToNextWeek(AppointmentRepository $appointmentRepository, Appointment $appointment): Response
    {
        $appointmentRepository->changeAppointmentCurrentWeekToNextWeek($appointment->getId());

        return $this->redirectToRoute("next_week");
    }

}
