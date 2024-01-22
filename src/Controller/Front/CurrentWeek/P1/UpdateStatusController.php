<?php

namespace App\Controller\Front\CurrentWeek\P1;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UpdateStatusController extends AbstractController
{

    /**
     * @Route("/update-task-status", name="update_task_status", methods={"POST"})
     */
    public function updateTaskStatus(Request $request)
    {
        $taskId = $request->request->get('taskId');
        $isChecked = $request->request->get('isChecked');

        return new JsonResponse(['success' => true]);
    }
}
