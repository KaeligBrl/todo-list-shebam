<?php

namespace App\Controller\Back;

use App\Entity\Appointment;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Form\Back\Appointment\AddAppointmentNextWeekType;
use App\Form\Back\Appointment\ModifyAppointmentNextWeekType;
use App\Form\Back\Appointment\AddAppointmentCurrentWeekType;
use App\Form\Back\Appointment\ModifyAppointmentCurrentWeekType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AppointmentController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/admin/liste-des-taches/rendez-vous/ajouter", name="appointment_cw_add_back")
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
     * @Route("/admin/liste-des-taches/semaine-suivante/rendez-vous/ajouter", name="appointment_nw_add_back")
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
     * @Route("/admin/liste-des-taches/rendez-vous/modifier/id={id}", name="appointment_cw_modify_back")
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
        return $this->render('back/current_week/appointment/modify.html.twig', [
            'form_appointment_nw_modify_back' => $form->createView(),
            'notification' => $notification,
            'appointment' => $appointmentModify
        ]);
    }

    /**
     * @Route("/admin/liste-des-taches/rendez-vous/semaine-suivante/modifier/id={id}", name="appointment_nw_modify_back")
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
        return $this->render('back/next_week/appointment/modify.html.twig', [
            'form_appointment_nw_modify_back' => $form->createView(),
            'notification' => $notification,
            'appointment' => $appointmentModify
        ]);
    }

    /**
     * @Route("/admin/liste-des-taches/rendez-vous/supprimer/id={id}", name="appointment_cw_detete_back")
     * @param Appointment $appointmentDelete
     * return RedirectResponse
     */
    public function deleteQuoteCurrentWeek(Appointment $appointmentDelete): RedirectResponse
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($appointmentDelete);
        $em->flush();

        return $this->redirectToRoute("mission_list_back");;
    }

    /**
     * @Route("/admin/liste-des-taches/rendez-vous/semaine-suivante/supprimer/id={id}", name="appointment_nw_detete_back")
     * @param Appointment $appointmentDelete
     * return RedirectResponse
     */
    public function deleteQuoteNextWeek(Appointment $appointmentDelete): RedirectResponse
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($appointmentDelete);
        $em->flush();

        return $this->redirectToRoute("mission_list_nw_back");;
    }

}
