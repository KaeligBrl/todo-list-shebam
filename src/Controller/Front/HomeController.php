<?php

namespace App\Controller\Front;

use App\Entity\Task;
use App\Entity\Appointment;
use App\Repository\TaskRepository;
use App\Repository\QuoteRepository;
use App\Repository\Task2Repository;
use App\Repository\AppointmentRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Front\Task\FrontTaskAddType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Front\Task\FrontAppointmentAddType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
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
        if($form->isSubmitted() && $form->isValid()) {
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
        if($formappointment->isSubmitted() && $formappointment->isValid()) {
            $this->entityManager->persist($taskAdd);
            $this->entityManager->flush();
            $notification = 'Le rendez-vous a bien été ajoutée';
            $appointmentAdd = new Appointment();
            $formappointment = $this->createForm(FrontAppointmentAddType::class, $appointmentAdd);
        }

        return $this->render('front/home/index.html.twig', [
            'task' => $taskAdmin->findAll(),
            'appointment' => $appointmentAdmin->findAll(),
            'quote' => $quoteAdmin->findAll(),
            'task2' => $task2Admin->findAll(),
            'form_task_p1_add_front' => $form->createView(),
            'form_appointment_add_admin' => $formappointment->createView(),
            'notification' => $notification,
        ]);
    }

}
