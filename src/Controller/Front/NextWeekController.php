<?php

namespace App\Controller\Front;

use App\Entity\Task;
use App\Entity\Quote;
use App\Entity\Appointment;
use App\Repository\TaskRepository;
use App\Repository\QuoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AppointmentRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Front\Quote\AddQuoteNextWeekType;
use App\Form\Front\Task\AddTaskP1NextWeekType;
use App\Form\Front\Task\AddTaskP2NextWeekType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Form\Front\Appointment\AddAppointmentNextWeekType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NextWeekController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/semaine-suivante/", name="next_week")
     */
    public function index(TaskRepository $taskAdmin, AppointmentRepository $appointmentAdmin, QuoteRepository $quoteAdmin, Request $request): Response
    {
        $taskP1Add = new Task();
        $form_p1 = $this->createForm(AddTaskP1NextWeekType::class, $taskP1Add);
        $notification = null;
        $form_p1->handleRequest($request);
        if ($form_p1->isSubmitted() && $form_p1->isValid()) {
            $this->entityManager->persist($taskP1Add);
            $this->entityManager->flush();
            return $this->redirectToRoute("next_week");
        }

        $taskP2Add = new Task();
        $form_p2 = $this->createForm(AddTaskP2NextWeekType::class, $taskP2Add);
        $notification = null;
        $form_p2->handleRequest($request);
        if ($form_p2->isSubmitted() && $form_p2->isValid()) {
            $this->entityManager->persist($taskP2Add);
            $this->entityManager->flush();
            return $this->redirectToRoute("next_week");
        }

        $appointmentAdd = new Appointment();
        $formappointment = $this->createForm(AddAppointmentNextWeekType::class, $appointmentAdd);
        $notification = null;
        $formappointment->handleRequest($request);
        if ($formappointment->isSubmitted() && $formappointment->isValid()) {
            $this->entityManager->persist($appointmentAdd);
            $this->entityManager->flush();
            return $this->redirectToRoute("next_week");
        }

        $quoteAdd = new Quote();
        $formquote = $this->createForm(AddQuoteNextWeekType::class, $quoteAdd);
        $notification = null;
        $formquote->handleRequest($request);
        if ($formquote->isSubmitted() && $formquote->isValid()) {
            $this->entityManager->persist($quoteAdd);
            $this->entityManager->flush();
            return $this->redirectToRoute("next_week");
        }


        return $this->render('front/next_week/index.html.twig', [
            'task' => $taskAdmin->findBy([], ['position' => 'ASC']),
            'appointment' => $appointmentAdmin->findBy([], ['hoursappointment' => 'ASC']),
            'quote' => $quoteAdmin->findBy([], ['position' => 'ASC']),
            'form_task_p1_nw_add_front' => $form_p1->createView(),
            'form_task_p2_nw_add_front' => $form_p2->createView(),
            'form_appointment_nw_add_front' => $formappointment->createView(),
            'form_quote_nw_add_front' => $formquote->createView(),
            'notification' => $notification,
        ]);
    }

    /**
     * @Route("/semaine-suivante/tache/supprimer/id={id}/", name="delete_task_nw_front")
     * @param Task $taskDelete
     * return RedirectResponse
     */
    public function deleteTask(Task $taskDelete): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($taskDelete);
        $em->flush();

        return $this->redirectToRoute("next_week");
    }

    /**
     * @Route("/semaine-suivante/rendez-vous/supprimer/id={id}", name="delete_appointment_nw_front")
     * @param Appointment $appointmentDelete
     * return RedirectResponse
     */
    public function deleteAppointment(Appointment $appointmentDelete): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($appointmentDelete);
        $em->flush();

        return $this->redirectToRoute("next_week");
    }

    /**
     * @Route("/semaine-suivante/devis/supprimer/id={id}", name="delete_quote_nw_front")
     * @param Quote $quoteDelete
     * return RedirectResponse
     */
    public function deleteQuote(Quote $quoteDelete): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($quoteDelete);
        $em->flush();

        return $this->redirectToRoute("next_week");
    }

    /**
     * @Route("/semaine-suivante/tache-p2/basculement-vers-p1/={id}", name="change_task_nw_to_p1_front")
     * return RedirectResponse
     */
    public function changeTaskToP1NextWeek(Task $task): Response
    {

        $rep = $this->getDoctrine()
            ->getRepository(Task::class)
            ->setChangeTaskForP1NextWeek($task->getId());

        return $this->redirectToRoute("next_week");
    }

    /**
     * @Route("/semaine-suivante/tache-p1/basculement-vers-p2/id={id}", name="change_task_nw_to_p2_front")
     * return RedirectResponse
     */
    public function changeTaskToP2NextWeek(Task $task): Response
    {

        $rep = $this->getDoctrine()
            ->getRepository(Task::class)
            ->setChangeTaskForP2NextWeek($task->getId());

        return $this->redirectToRoute("next_week");
    }

    /**
     * @Route("/semaine-suivante/basculer-p1-en-semaine-actuelle/id={id}", name="change_task_p1_nw_to_p1_cw_front")
     * return RedirectResponse
     */
    public function changeTaskP1NextWeekToP1CurrentWeek(Task $task): Response
    {
        $rep = $this->getDoctrine()
            ->getRepository(Task::class)
            ->setChangeTaskP1NextWeekToP1CurrentWeek($task->getId());

        return $this->redirectToRoute("next_week");
    }

    /**
     * @Route("/semaine-suivante/basculer-p2-en-semaine-actuelle/id={id}", name="change_task_p2_nw_to_p2_cw_front")
     * return RedirectResponse
     */
    public function changeTaskP2NextWeekToP2CurrentWeek(Task $task): Response
    {
        $rep = $this->getDoctrine()
            ->getRepository(Task::class)
            ->setChangeTaskP2NextWeekToP2CurrentWeek($task->getId());

        return $this->redirectToRoute("next_week");
    }

    /**
     * @Route("/semaine-suivante/rendez-vous/basculer-en-semaine-actuelle/id={id}", name="change_appointment_nw_to_cw_front")
     * return RedirectResponse
     */
    public function changeAppointmentNextWeekToCurrentWeek(Appointment $appointmentChange): Response
    {
        $rep = $this->getDoctrine()
            ->getRepository(Appointment::class)
            ->setChangeAppointmentNextWeekToCurrentWeek($appointmentChange->getId());

        return $this->redirectToRoute("next_week");
    }

    /**
     * @Route("/semaine-suivante/devis/basculer-en-semaine-actuelle/id={id}", name="change_quote_nw_to_cw_front")
     * return RedirectResponse
     */
    public function changeQuoteNextWeekToCurrentWeek(Quote $quoteChange): Response
    {
        $rep = $this->getDoctrine()
            ->getRepository(Quote::class)
            ->setChangeQuoteNextWeekToCurrentWeek($quoteChange->getId());

        return $this->redirectToRoute("next_week");
    }

    /**
     * @Route("/semaine-suivante/changer-vers-semaine-actuelle/", name="mission_nw_change_to_cw_front")
     */
    public function changeTaskToCurrentWeek(): Response
    {

        $rep1 = $this->getDoctrine()
            ->getRepository(Task::class)
            ->setRemoveTask();

        $rep2 = $this->getDoctrine()
            ->getRepository(Appointment::class)
            ->setRemoveAppointment();

        $rep3 = $this->getDoctrine()
            ->getRepository(Quote::class)
            ->setRemoveQuote();

        $rep4 = $this->getDoctrine()
            ->getRepository(Task::class)
            ->setchangeTaskToCurrentWeek();

        $rep5 = $this->getDoctrine()
            ->getRepository(Appointment::class)
            ->setchangeAppointmentToCurrentWeek();

        $rep6 = $this->getDoctrine()
            ->getRepository(Quote::class)
            ->setchangeQuoteToCurrentWeek();



        return $this->redirectToRoute("mission_list_nw_back");
    }

    /**
     * @Route("/semaine-suivante/reorder", name="reorder_row_nw_front")
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
