<?php

namespace App\Controller\Front\NextWeek\Appointment;

use App\Entity\Appointment;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AppointmentRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\Front\Appointment\AddAppointmentNextWeekType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    #[Route('/semaine-suivante/rendez-vous', name: 'next_week_appointment')]
    public function index(
        AppointmentRepository $appointmentList,
        UserRepository $userRepository,
        Request $request,
    ): Response
    {
        $appointmentAdd = new Appointment();
        $appointmentAdd->setNextweek(true);
        $formappointment = $this->createForm(AddAppointmentNextWeekType::class, $appointmentAdd);
        $notification = null;
        $formappointment->handleRequest($request);

        if ($formappointment->isSubmitted() && $formappointment->isValid()) {
            $appointmentAdd->setNextweek(true);
            $this->entityManager->persist($appointmentAdd);
            $this->entityManager->flush();
            return $this->redirectToRoute("next_week_appointment");
        }

        return $this->render('front/next_week/appointment/list.html.twig', [
            'appointment' => $appointmentList->findBy([], ['hoursappointment' => 'ASC']),
            'usersList' => $userRepository->findBy([], ['firstname' => 'ASC']),
            'form_appointment_nw_add' => $formappointment->createView(),

            'notification' => $notification,
        ]);
    }
}
