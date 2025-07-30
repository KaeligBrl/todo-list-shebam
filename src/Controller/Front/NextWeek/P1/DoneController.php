<?php

namespace App\Controller\Front\NextWeek\P1;

use App\Entity\Task;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class DoneController extends AbstractController
{

    #[Route('/semaine-suivante/fait/p1/{id}', name: 'done_task_nw_p1_checkbox')]
    public function taskDone(Task $taskdone, EntityManagerInterface $entityManager) {
        $taskdone->setDone(($taskdone->getDone()) ? false : true);
        $em = $entityManager;
        $entityManager->persist($taskdone);
        $entityManager->flush();

        return new Response("true");
    }

}
