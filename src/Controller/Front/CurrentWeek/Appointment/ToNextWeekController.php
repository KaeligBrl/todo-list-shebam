<?php

namespace App\Controller\Front\CurrentWeek\Appointment;

use App\Entity\Appointment;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AppointmentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Form\Front\Appointment\AddAppointmentCurrentWeekType;
use App\Form\Front\Appointment\ModifyAppointmentCurrentWeekType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ToNextWeekController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/semaine-actuelle/rendez-vous/basculer/semaine-suivante/{id}", name="change_cw_to_nw_appointment")
     * return RedirectResponse
     */
    public function changeAppointmentNextWeekToCurrentWeek(Appointment $appointment, AppointmentRepository $appointRepository): Response
    {
        $appointRepository->setChangeAppointmentCurrentWeekToNextWeek($appointment->getId());

        return $this->redirectToRoute("current_week_appointment");
    }
}
