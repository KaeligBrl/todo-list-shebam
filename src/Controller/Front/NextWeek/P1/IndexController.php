<?php

namespace App\Controller\Front\NextWeek\P1;

use App\Entity\Appointment;
use App\Entity\Task;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Front\Task\AddTaskP1NextWeekType;
use App\Repository\AppointmentRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/semaine-suivante/p1", name="next_week_p1")
     */
    public function index(TaskRepository $taskList,Request $request, AppointmentRepository $appointmentRepository): Response
    {
        $taskAdd = new Task();
        $form_p1 = $this->createForm(AddTaskP1NextWeekType::class, $taskAdd);
        $notification = null;
        $form_p1->handleRequest($request);
        if ($form_p1->isSubmitted() && $form_p1->isValid()) {
            $this->entityManager->persist($taskAdd);
            $this->entityManager->flush();
            return $this->redirectToRoute("next_week_p1");
        }

        return $this->render('front/next_week/task/p1/list.html.twig', [
            'task' => $taskList->findBy([], ['position' => 'ASC']),
            'form_task_nw_p1_add' => $form_p1->createView(),
            'notification' => $notification,
            'appointment' => $appointmentRepository
        ]);
    }

}
