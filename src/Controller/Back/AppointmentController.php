<?php

namespace App\Controller\Back;

use App\Entity\Appointment;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Form\Front\Appointment\AddAppointmentNextWeekType;
use App\Form\Front\Appointment\ModifyAppointmentNextWeekType;
use App\Form\Front\Appointment\AddAppointmentCurrentWeekType;
use App\Form\Front\Appointment\ModifyAppointmentCurrentWeekType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AppointmentController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/semaine-actuelle/rendez-vous/ajouter", name="add_appointment_cw")
     */
    public function addTaskAppointment(Request $request): Response
    {
        $appointmentAdd = new Appointment();
        $form = $this->createForm(AddAppointmentCurrentWeekType::class, $appointmentAdd);
        $notification = null;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($appointmentAdd);
            $this->entityManager->flush();
            $notification = 'Le rendez-vous a bien été ajoutée';
            $appointmentAdd = new Appointment();
            $form = $this->createForm(AddAppointmentCurrentWeekType::class, $appointmentAdd);
        }
        return $this->render('back/current_week/appointment/add.html.twig', [
            'form_appointment_cw_add_back' => $form->createView(),
            'notification' => $notification
        ]);
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

    /**
     * @Route("/semaine-actuelle/rendez-vous/modifier/id={id}", name="modify_appointment_cw")
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

    /**
     * @Route("/semaine-suivante/rendez-vous/modifier/id={id}", name="modify_appointment_nw")
     */
    public function modifyAppointmentNextWeek(Request $request, Appointment $appointmentModify): Response
    {
        $form = $this->createForm(ModifyAppointmentNextWeekType::class, $appointmentModify);
        $notification = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $appointmentModify = $form->getData();
            $this->entityManager->persist($appointmentModify);
            $this->entityManager->flush();
            $notification = 'Le rendez-vous a bien été mise à jour !';
            $form = $this->createForm(ModifyAppointmentNextWeekType::class, $appointmentModify);
        }
        return $this->render('front/next_week/appointment/modify.html.twig', [
            'form_appointment_nw_modify' => $form->createView(),
            'notification' => $notification,
            'appointment' => $appointmentModify
        ]);
    }

    /**
     * @Route("/semaine-actuelle/rendez-vous/supprimer/id={id}", name="delete_appointment_cw_back")
     * @param Appointment $appointmentDelete
     * return RedirectResponse
     */
    public function deleteQuoteCurrentWeek(Appointment $appointmentDelete): RedirectResponse
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($appointmentDelete);
        $em->flush();

        return $this->redirectToRoute("current_week");;
    }

    /**
     * @Route("/semaine-suivante/rendez-vous/supprimer/id={id}", name="delete_appointment_nw_back")
     * @param Appointment $appointmentDelete
     * return RedirectResponse
     */
    public function deleteQuoteNextWeek(Appointment $appointmentDelete): RedirectResponse
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($appointmentDelete);
        $em->flush();

        return $this->redirectToRoute("next_week");;
    }

    /**
     * @Route("/semaine-actuelle/basculer/rendez-vous/semaine-suivante/id={id}", name="change_appointment_cw_to_nw_back")
     * return RedirectResponse
     */
    public function changeQuoteCurrentToNextWeek(Appointment $quoteChange): Response
    {
        $rep = $this->getDoctrine()
            ->getRepository(Appointment::class)
            ->setChangeAppointmentCurrentWeekToNextWeek($quoteChange->getId());

        return $this->redirectToRoute("next_week");
    }

    /**
     * @Route("/semaine-suivante/basculer/rendez-vous/semaine-actuelle/id={id}", name="change_appointment_nw_to_cw_back")
     * return RedirectResponse
     */
    public function changeAppointmentNextToCurrentWeek(Appointment $appointmentChange): Response
    {
        $rep = $this->getDoctrine()
            ->getRepository(Appointment::class)
            ->setChangeAppointmentNextWeekToCurrentWeek($appointmentChange->getId());

        return $this->redirectToRoute("next_week");
    }

}
