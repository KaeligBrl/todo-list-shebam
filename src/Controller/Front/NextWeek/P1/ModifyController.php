<?php

namespace App\Controller\Front\NextWeek\P1;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Front\Task\ModifyTaskP1NextWeekType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModifyController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/semaine-suivante/p1/modifier/{id}", name="modify_task_p1_nw")
     */
    public function modifyTaskP1Cw(Request $request, Task $taskModify): Response
    {
        $form = $this->createForm(ModifyTaskP1NextWeekType::class, $taskModify);
        $notification = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $taskModify = $form->getData();
            $this->entityManager->persist($taskModify);
            $this->entityManager->flush();
            $notification = 'La tâche a été mise à jour !';
            $form = $this->createForm(ModifyTaskP1NextWeekType::class, $taskModify);

        }
        return $this->render('front/next_week/task/p1/modify.html.twig', [
            'form_task_p1_nw_modify' => $form->createView(),
            'notification' => $notification,
            'task' => $taskModify
        ]);
    }

}
