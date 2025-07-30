<?php

namespace App\Controller\Front\CurrentWeek\P1;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DoneController extends AbstractController
{
    #[Route('/semaine-actuelle/fait/p1/{id}', name: 'done_task_cw_p1_checkbox')]
    public function taskDone(Task $taskdone, EntityManagerInterface $entityManager) {
        $taskdone->setDone(($taskdone->getDone()) ? false : true);
        $entityManager->persist($taskdone);
        $entityManager->flush();

        return new Response("true");
    }
}
