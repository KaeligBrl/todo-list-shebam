<?php

namespace App\Controller\Front\CurrentWeek\P2;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Front\Task\AddTaskP2CurrentWeekType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/semaine-actuelle/p2", name="current_week_p2")
     */
    public function index(TaskRepository $taskList,Request $request): Response
    {

        $taskp2Add = new Task();
        $form_p2 = $this->createForm(AddTaskP2CurrentWeekType::class, $taskp2Add);
        $notification = null;
        $form_p2->handleRequest($request);
        if ($form_p2->isSubmitted() && $form_p2->isValid()) {
            $this->entityManager->persist($taskp2Add);
            $this->entityManager->flush();
            return $this->redirectToRoute("home");
        }

        return $this->render('front/current_week/task/p2/list.html.twig', [
            'task' => $taskList->findBy([], ['position' => 'ASC']),
            'form_task_cw_p2_add' => $form_p2->createView(),
            'notification' => $notification,
        ]);
    }
}
