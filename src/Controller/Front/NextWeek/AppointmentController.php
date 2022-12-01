<?php

namespace App\Controller\Front\NextWeek;

use App\Entity\Appointment;
use App\Repository\TaskRepository;
use App\Repository\QuoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AppointmentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Form\Front\Appointment\AddAppointmentNextWeekType;
use App\Form\Front\Appointment\ModifyAppointmentNextWeekType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AppointmentController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/semaine-suivante/rendez-vous", name="next_week_appointment")
     */
    public function index(AppointmentRepository $appointmentList, Request $request): Response
    {
        $appointmentAdd = new Appointment();
        $formappointment = $this->createForm(AddAppointmentNextWeekType::class, $appointmentAdd);
        $notification = null;
        $formappointment->handleRequest($request);
        if ($formappointment->isSubmitted() && $formappointment->isValid()) {
            $this->entityManager->persist($appointmentAdd);
            $this->entityManager->flush();
            return $this->redirectToRoute("next_week_appointment");
            
        }

        return $this->render('front/next_week/appointment/list.html.twig', [
            'appointment' => $appointmentList->findBy([], ['hoursappointment' => 'ASC']),
            'form_appointment_nw_add' => $formappointment->createView(),

            'notification' => $notification,
        ]);
    }

    /**
     * @Route("/semaine-suivante/rendez-vous/modifier/{id}", name="modify_nw_appointment")
     */
    public function modifyAppointment(Request $request, Appointment $appointmentModify): Response
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
     * @Route("/semaine-suivante/rendez-vous/supprimer/{id}", name="delete_nw_appointment")
     * @param Appointment $appointmentDelete
     * return RedirectResponse
     */
    public function deleteAppointment(Appointment $appointmentDelete): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($appointmentDelete);
        $em->flush();

        return $this->redirectToRoute("next_week_appointment");
    }

    /**
     * @Route("/semaine-suivante/rendez-vous/basculer/semaine-actuelle/{id}", name="change_nw_to_nw_appointment")
     * return RedirectResponse
     */
    public function changeAppointmentNextWeekToCurrentWeek(Appointment $appointmentChange): Response
    {
        $rep = $this->getDoctrine()
            ->getRepository(Appointment::class)
            ->setChangeAppointmentNextWeekToCurrentWeek($appointmentChange->getId());

        return $this->redirectToRoute("next_week_appointment");
    }

    /**
     * @Route("/reorder", name="reorder")
     */
    public function reorderTaskP1Row(Request $request, TaskRepository $taskRow, AppointmentRepository $appointmentRow, QuoteRepository $quoteRow)
    {
        $cpt = 0;
        switch ($request->request->get("context")) {
            case '1':
                foreach (json_decode($request->request->get("table"), true /* est-ce que je veux un tableau assoc oui (par défaut false) */) as $row) {
                    $task = $taskRow->find($row['id']); //on récupère la task
                    $task->setPosition($cpt); //on definit la position
                    $cpt++; //on ajoute une rangée
                }
            break;

            case '2':
                foreach (json_decode($request->request->get("table"), true) as $row) {
                    $appt = $appointmentRow->find($row['id']);
                    $appt->setPosition($cpt);
                    $cpt++;
                }
            break;

            case '3':
                foreach (json_decode($request->request->get("table"), true) as $row) {
                    $quote = $quoteRow->find($row['id']);
                    $quote->setPosition($cpt);
                    $cpt++;
                }
            break;
        }

        $this->entityManager->flush();
        return new JsonResponse([
            'data' => gettype($request->request->get("context"))
        ]);
    }
}
