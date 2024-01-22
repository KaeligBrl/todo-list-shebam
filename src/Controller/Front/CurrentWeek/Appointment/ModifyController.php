<?php

namespace App\Controller\Front\CurrentWeek\Appointment;

use App\Entity\Appointment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Front\Appointment\ModifyAppointmentCurrentWeekType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModifyController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/semaine-actuelle/rendez-vous/modifier/{id}", name="modify_cw_appointment")
     */
    public function modifyAppointment(Request $request, Appointment $appointmentModify): Response
    {
        $form = $this->createForm(ModifyAppointmentCurrentWeekType::class, $appointmentModify);
        $notification = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $appointmentModify = $form->getData();
            $this->entityManager->persist($appointmentModify);
            $this->entityManager->flush();
            $notification = 'Le rendez-vous a bien été mise à jour !';
            $form = $this->createForm(ModifyAppointmentCurrentWeekType::class, $appointmentModify);
        }
        return $this->render('front/current_week/appointment/modify.html.twig', [
            'form_appointment_nw_modify' => $form->createView(),
            'notification' => $notification,
            'appointment' => $appointmentModify
        ]);
    }
}
