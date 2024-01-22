<?php

namespace App\Controller\Front\CurrentWeek\P1;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Front\Task\ModifyTaskP1CurrentWeekType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModifyController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/semaine-actuelle/p1/modifier/{id}", name="modify_task_p1_cw")
     */
    public function modifyTaskP1Cw(Request $request, Task $taskModify): Response
    {
        $form = $this->createForm(ModifyTaskP1CurrentWeekType::class, $taskModify);
        $notification = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $taskModify = $form->getData();
            $this->entityManager->persist($taskModify);
            $this->entityManager->flush();
            $notification = 'La tâche a été mise à jour !';
            $form = $this->createForm(ModifyTaskP1CurrentWeekType::class, $taskModify);
        }
        return $this->render('front/current_week/task/p1/modify.html.twig', [
            'form_task_p1_cw_modify' => $form->createView(),
            'notification' => $notification,
            'task' => $taskModify
        ]);
    }
}
