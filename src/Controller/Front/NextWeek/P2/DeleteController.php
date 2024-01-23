<?php

namespace App\Controller\Front\NextWeek\P2;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteController extends AbstractController
{
    /**
     * @Route("/semaine-suivante/p2/supprimer/{id}", name="delete_task_nw_p2")
     */
    public function deleteTask(Task $taskDelete, EntityManagerInterface $entityManager): RedirectResponse
    {
        $entityManager->remove($taskDelete);
        $entityManager->flush();

        return $this->redirectToRoute("next_week_p2");
    }

}
