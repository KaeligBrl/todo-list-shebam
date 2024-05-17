<?php

namespace App\Controller\Front\CurrentWeek\Appointment;

use App\Entity\Appointment;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AppointmentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Front\Appointment\AddAppointmentCurrentWeekType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/semaine-actuelle/rendez-vous", name="current_week_appointment")
     */
    public function index(AppointmentRepository $appointmentList, Request $request): Response
    {
        $appointmentAdd = new Appointment();
        $formappointment = $this->createForm(AddAppointmentCurrentWeekType::class, $appointmentAdd);
        $notification = null;
        $formappointment->handleRequest($request);

        if ($formappointment->isSubmitted() && $formappointment->isValid()) {
            $this->entityManager->persist($appointmentAdd);
            $this->entityManager->flush();
            return $this->redirectToRoute("current_week_appointment");
        }

        return $this->render('front/current_week/appointment/list.html.twig', [
            'appointment' => $appointmentList->findBy([], ['hoursappointment' => 'ASC']),
            'form_appointment_cw_add_front' => $formappointment->createView(),
            'notification' => $notification,
        ]);
    }
}
