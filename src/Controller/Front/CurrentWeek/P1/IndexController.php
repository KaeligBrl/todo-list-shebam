<?php

namespace App\Controller\Front\CurrentWeek\P1;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AppointmentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Front\Task\AddTaskP1CurrentWeekType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/semaine-actuelle/p1", name="current_week_p1")
     */
    public function index(TaskRepository $taskList,AppointmentRepository $appointment, Request $request): Response
    {
    
        $taskAdd = new Task();
        $form_p1 = $this->createForm(AddTaskP1CurrentWeekType::class, $taskAdd);
        $notification = null;
        $form_p1->handleRequest($request);
        if ($form_p1->isSubmitted() && $form_p1->isValid()) {
            $this->entityManager->persist($taskAdd);
            $this->entityManager->flush();
            return $this->redirectToRoute("current_week_p1");
        }

        return $this->render('front/current_week/task/p1/list.html.twig', [
            'task' => $taskList->findBy([], ['position' => 'ASC']),
            'appointment' => $appointment,
            'form_task_cw_p1_add' => $form_p1->createView(),
            'notification' => $notification,
        ]);
    }

}
