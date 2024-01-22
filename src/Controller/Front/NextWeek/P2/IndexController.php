<?php

namespace App\Controller\Front\NextWeek\P2;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Front\Task\AddTaskP2NextWeekType;
use App\Form\Front\Task\ModifyTaskP2NextWeekType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    /**
     * @Route("/semaine-suivante/p2", name="next_week_p2")
     */
    public function index(TaskRepository $taskList,Request $request): Response
    {
        $taskp2Add = new Task();
        $form_p2 = $this->createForm(AddTaskP2NextWeekType::class, $taskp2Add);
        $notification = null;
        $form_p2->handleRequest($request);
        if ($form_p2->isSubmitted() && $form_p2->isValid()) {
            $this->entityManager->persist($taskp2Add);
            $this->entityManager->flush();
            return $this->redirectToRoute("next_week_p2");
        }

        return $this->render('front/next_week/task/p2/list.html.twig', [
            'task' => $taskList->findBy([], ['position' => 'ASC']),
            'form_task_cw_p2_add' => $form_p2->createView(),
            'notification' => $notification,
        ]);
    }

}
