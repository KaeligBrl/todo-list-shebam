<?php

namespace App\Controller\Front\NextWeek\P1;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteController extends AbstractController
{
    /**
     * @Route("/semaine-suivante/p1/supprimer/{id}", name="delete_task_nw_p1")
     */
    public function deleteTask(Task $taskDelete, EntityManagerInterface $entityManager): RedirectResponse
    {
        $entityManager->remove($taskDelete);
        $entityManager->flush();

        return $this->redirectToRoute("next_week_p1");
    }

}
