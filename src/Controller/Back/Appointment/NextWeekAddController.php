<?php

namespace App\Controller\Back\Appointment;

use App\Entity\Appointment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Front\Appointment\AddAppointmentNextWeekType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NextWeekAddController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/semaine-suivante/rendez-vous/ajouter", name="add_appointment_nw")
     */
    public function addTaskAppointmentNextWeek(Request $request): Response
    {
        $appointmentAdd = new Appointment();
        $form = $this->createForm(AddAppointmentNextWeekType::class, $appointmentAdd);
        $notification = null;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($appointmentAdd);
            $this->entityManager->flush();
            $notification = 'Le rendez-vous a bien été ajouté';
            $appointmentAdd = new Appointment();
            $form = $this->createForm(AddAppointmentNextWeekType::class, $appointmentAdd);
        }
        return $this->render('back/next_week/appointment/add.html.twig', [
            'form_appointment_nw_add_back' => $form->createView(),
            'notification' => $notification
        ]);
    }

}
