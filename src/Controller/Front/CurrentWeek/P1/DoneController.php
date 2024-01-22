<?php

namespace App\Controller\Front\CurrentWeek\P1;

use App\Entity\Task;;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DoneController extends AbstractController
{
    /**
     * @Route("/semaine-actuelle/fait/p1/{id}", name="done_task_cw_p1_checkbox")
     */
    public function taskDone(Task $taskdone)
    {
        $taskdone->setDone(($taskdone->getDone()) ? false : true);
        $em = $this->getDoctrine()->getManager();
        $em->persist($taskdone);
        $em->flush();

        return new Response("true");
    }
}
