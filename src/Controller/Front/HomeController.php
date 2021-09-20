<?php

namespace App\Controller\Front;

use App\Entity\Task;
use App\Entity\Quote;
use App\Entity\Task2;
use App\Entity\Appointment;
use App\Repository\TaskRepository;
use App\Repository\QuoteRepository;
use App\Repository\Task2Repository;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Front\Task\FrontTaskAddType;
use App\Repository\AppointmentRepository;
use App\Form\Front\Quote\FrontQuoteAddType;
use App\Form\Front\Task2\FrontTask2AddType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Form\Front\Appointment\FrontAppointmentAddType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/", name="home")
     */
    public function index(TaskRepository $taskAdmin, AppointmentRepository $appointmentAdmin, QuoteRepository $quoteAdmin, Task2Repository $task2Admin, Request $request): Response
    {
        $taskAdd = new Task();
        $form = $this->createForm(FrontTaskAddType::class, $taskAdd);
        $notification = null;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($taskAdd);
            $this->entityManager->flush();
            return $this->redirectToRoute("home");
        }

        $appointmentAdd = new Appointment();
        $formappointment = $this->createForm(FrontAppointmentAddType::class, $appointmentAdd);
        $notification = null;
        $formappointment->handleRequest($request);
        if ($formappointment->isSubmitted() && $formappointment->isValid()) {
            $this->entityManager->persist($appointmentAdd);
            $this->entityManager->flush();
            return $this->redirectToRoute("home");
            
        }

        $quoteAdd = new Quote();
        $formquote = $this->createForm(FrontQuoteAddType::class, $quoteAdd);
        $notification = null;
        $formquote->handleRequest($request);
        if ($formquote->isSubmitted() && $formquote->isValid()) {
            $this->entityManager->persist($quoteAdd);
            $this->entityManager->flush();
            return $this->redirectToRoute("home");
        }

        $task2Add = new Task2();
        $formtask2 = $this->createForm(FrontTask2AddType::class, $task2Add);
        $notification = null;
        $formtask2->handleRequest($request);
        if ($formtask2->isSubmitted() && $formtask2->isValid()) {
            $this->entityManager->persist($task2Add);
            $this->entityManager->flush();
            return $this->redirectToRoute("home");
        }


        return $this->render('front/home/index.html.twig', [
            'task' => $taskAdmin->findBy([], ['position' => 'ASC']),
            'appointment' => $appointmentAdmin->findBy([], ['hoursappointment' => 'DESC']),
            'quote' => $quoteAdmin->findBy([], ['position' => 'ASC']),
            'task2' => $task2Admin->findBy([], ['position' => 'ASC']),
            'form_task_p1_add_front' => $form->createView(),
            'form_appointment_add_front' => $formappointment->createView(),
            'form_quote_add_front' => $formquote->createView(),
            'form_task2_add_front' => $formtask2->createView(),
            'notification' => $notification,
        ]);
    }

    /**
     * @Route("/tache/{id}/supprimer", name="task_detete_home")
     * @param Task $taskDelete
     * return RedirectResponse
     */
    public function deleteTask(Task $taskDelete): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($taskDelete);
        $em->flush();

        return $this->redirectToRoute("home");
    }

    /**
     * @Route("/tache2/{id}/supprimer", name="task2_detete_home")
     * @param Task2 $task2Delete
     * return RedirectResponse
     */
    public function deleteTask2(Task2 $task2Delete): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($task2Delete);
        $em->flush();

        return $this->redirectToRoute("home");
    }

    /**
     * @Route("/rendez-vous/{id}/supprimer", name="appointment_detete_home")
     * @param Appointment $appointmentDelete
     * return RedirectResponse
     */
    public function deleteAppointment(Appointment $appointmentDelete): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($appointmentDelete);
        $em->flush();

        return $this->redirectToRoute("home");
    }

    /**
     * @Route("/devis/{id}/supprimer", name="quote_detete_home")
     * @param Quote $quoteDelete
     * return RedirectResponse
     */
    public function deleteQuote(Quote $quoteDelete): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($quoteDelete);
        $em->flush();

        return $this->redirectToRoute("home");
    }

    /**
     * @Route("/reorder", name="home_reorder_row")
     */
    public function reorderTaskP1Row(Request $request, TaskRepository $taskRow, AppointmentRepository $appointmentRow, QuoteRepository $quoteRow, Task2Repository $task2Row)
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
            case '4':
                foreach (json_decode($request->request->get("table"), true) as $row) {
                    $task2 = $task2Row->find($row['id']);
                    $task2->setPosition($cpt);
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
