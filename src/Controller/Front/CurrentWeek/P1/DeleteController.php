<?php

namespace App\Controller\Front\CurrentWeek\P1;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteController extends AbstractController
{

    /**
     * @Route("/semaine-actuelle/p1/supprimer/{id}", name="delete_task_cw_p1")
     */
    public function deleteTask(Task $taskDelete, EntityManagerInterface $entityManager): RedirectResponse
    {
        $entityManager->remove($taskDelete);
        $entityManager->flush();

        return $this->redirectToRoute("current_week_p1");
    }
}
