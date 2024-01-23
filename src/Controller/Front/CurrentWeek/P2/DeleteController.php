<?php

namespace App\Controller\Front\CurrentWeek\P2;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteController extends AbstractController
{
    /**
     * @Route("/semaine-actuelle/p2/supprimer/{id}", name="delete_task_cw_p2")
     */
    public function deleteTask(Task $taskDelete, EntityManagerInterface $entityManager): RedirectResponse
    {
        $entityManager->remove($taskDelete);
        $entityManager->flush();

        return $this->redirectToRoute("current_week_p2");
    }
}
