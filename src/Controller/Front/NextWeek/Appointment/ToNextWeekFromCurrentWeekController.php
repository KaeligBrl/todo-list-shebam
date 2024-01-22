<?php

namespace App\Controller\Front\NextWeek\Appointment;

use App\Entity\Appointment;
use App\Repository\AppointmentRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ToNextWeekFromCurrentWeekController extends AbstractController
{

    /**
     * @Route("/semaine-suivante/rendez-vous/basculer/semaine-actuelle/{id}", name="change_nw_to_nw_appointment")
     * return RedirectResponse
     */
    public function changeAppointmentNextWeekToCurrentWeek(Appointment $appointment, AppointmentRepository $appointmentRepository): Response
    {
        $appointmentRepository->setChangeAppointmentNextWeekToCurrentWeek($appointment->getId());

        return $this->redirectToRoute("next_week_appointment");
    }
}
