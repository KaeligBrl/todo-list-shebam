<?php

namespace App\Controller\Back\Appointment;

use App\Entity\Appointment;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AppointmentRepository;
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
     * @Route("/semaine-suivante/basculer/rendez-vous/semaine-actuelle/id={id}", name="change_appointment_nw_to_cw_back")
     * return RedirectResponse
     */
    public function changeQuoteCurrentToNextWeek(AppointmentRepository $appointmentRepository, Appointment $appointment): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $entityManager->$appointmentRepository;

        $repository->setChangeAppointmentNextWeekToCurrentWeek($appointment->getId());

        return $this->redirectToRoute("next_week");
    }

}
