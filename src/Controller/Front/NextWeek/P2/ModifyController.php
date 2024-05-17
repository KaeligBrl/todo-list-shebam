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
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModifyController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    /**
     * @Route("/semaine-suivante/p2/modifier/{id}", name="modify_task_nw_p2")
     */
    public function modifyTaskP2CurrentWeek(Request $request, Task $taskModify): Response
    {
        $form = $this->createForm(ModifyTaskP2NextWeekType::class, $taskModify);
        $notification = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $taskModify = $form->getData();
            $this->entityManager->persist($taskModify);
            $this->entityManager->flush();
            $notification = 'La tâche a été mise à jour !';
            $form = $this->createForm(ModifyTaskP2NextWeekType::class, $taskModify);
        }
        
        return $this->render('front/next_week/task/p2/modify.html.twig', [
            'form_task_p2_cw_modify' => $form->createView(),
            'notification' => $notification,
            'task' => $taskModify
        ]);
    }
}
