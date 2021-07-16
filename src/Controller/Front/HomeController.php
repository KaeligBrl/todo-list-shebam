<?php

namespace App\Controller\Front;

use App\Entity\Task;
use App\Entity\Quote;
use App\Entity\Appointment;
use App\Repository\TaskRepository;
use App\Repository\QuoteRepository;
use App\Repository\Task2Repository;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Front\Task\FrontTaskAddType;
use App\Repository\AppointmentRepository;
use App\Form\Front\Quote\FrontQuoteAddType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Front\Task\FrontAppointmentAddType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

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
            $notification = 'La tâche a bien été ajoutée';
            $taskAdd = new Task();
            $form = $this->createForm(FrontTaskAddType::class, $taskAdd);
        }

        $appointmentAdd = new Appointment();
        $formappointment = $this->createForm(FrontAppointmentAddType::class, $appointmentAdd);
        $notification = null;
        $formappointment->handleRequest($request);
        if ($formappointment->isSubmitted() && $formappointment->isValid()) {
            $this->entityManager->persist($appointmentAdd);
            $this->entityManager->flush();
            $notification = 'Le rendez-vous a bien été ajoutée';
            $appointmentAdd = new Appointment();
            $formappointment = $this->createForm(FrontAppointmentAddType::class, $appointmentAdd);
        }

        $quoteAdd = new Quote();
        $formquote = $this->createForm(FrontQuoteAddType::class, $quoteAdd);
        $notification = null;
        $formquote->handleRequest($request);
        if ($formquote->isSubmitted() && $formquote->isValid()) {
            $this->entityManager->persist($quoteAdd);
            $this->entityManager->flush();
            $notification = 'Le rendez-vous a bien été ajoutée';
            $appointmentAdd = new Appointment();
            $formquote = $this->createForm(FrontQuoteAddType::class, $quoteAdd);
        }

        return $this->render('front/home/index.html.twig', [
            'task' => $taskAdmin->findBy([], ['position' => 'ASC']),
            'appointment' => $appointmentAdmin->findBy([], ['position' => 'ASC']),
            'quote' => $quoteAdmin->findBy([], ['position' => 'ASC']),
            'task2' => $task2Admin->findBy([], ['position' => 'ASC']),
            'form_task_p1_add_front' => $form->createView(),
            'form_appointment_add_front' => $formappointment->createView(),
            'form_quote_add_front' => $formquote->createView(),
            'notification' => $notification,
        ]);
    }

    /**
     * @Route("/reorder", name="home_reorder_row")
     */
    public function reorderRow(Request $request, TaskRepository $taskP1Row , AppointmentRepository $appointmentRow, QuoteRepository $quoteRow, Task2Repository $taskP2Row)
    {
        $cpt = 0;
        switch ($request->request->get("context")) {
            case '1':
                foreach (json_decode($request->request->get("table"), true /* est-ce que je veux un tableau assoc oui (par défaut false) */) as $row) {
                    $task = $taskP1Row->find($row['id']); //on récupère la task
                    $task->setPosition($cpt); //on definit la position
                    $cpt++; //on ajoute une rangée
                }
            break;
            case '2':
                foreach (json_decode($request->request->get("table"), true /* est-ce que je veux un tableau assoc oui (par défaut false) */) as $row) {
                    $appointment = $appointmentRow->find($row['id']); //on récupère la task
                    $appointment->setPosition($cpt); //on definit la position
                    $cpt++; //on ajoute une rangée
                }
            break;
            case '3':
                foreach (json_decode($request->request->get("table"), true /* est-ce que je veux un tableau assoc oui (par défaut false) */) as $row) {
                    $quote = $quoteRow->find($row['id']); //on récupère la task
                    $quote->setPosition($cpt); //on definit la position
                    $cpt++; //on ajoute une rangée
                }
            break;
            case '4':
                foreach (json_decode($request->request->get("table"), true /* est-ce que je veux un tableau assoc oui (par défaut false) */) as $row) {
                    $taskp2 = $taskP2Row->find($row['id']); //on récupère la task
                    $taskp2->setPosition($cpt); //on definit la position
                    $cpt++; //on ajoute une rangée
                }
            break;
        }
        $this->entityManager->flush();
        return new JsonResponse([
            'data' => gettype($request->request->get("context"))
        ]);
    }
}
