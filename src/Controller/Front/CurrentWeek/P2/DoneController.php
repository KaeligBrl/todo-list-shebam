<?php

namespace App\Controller\Front\CurrentWeek\P2;

use App\Entity\Task;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class DoneController extends AbstractController
{

    #[Route('/semaine-actuelle/fait/p2/{id}', name: 'done_task_cw_p2_checkbox')]
    public function taskDone(Task $taskdone, EntityManagerInterface $entityManager) {
        $taskdone->setDone(($taskdone->getDone()) ? false : true);
        $em = $entityManager;
        $entityManager->persist($taskdone);
        $entityManager->flush();

        return new Response("true");
    }
}
