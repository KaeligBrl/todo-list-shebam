<?php

namespace App\Controller\Front\CurrentWeek\P2;

use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AppointmentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReorderController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    #[Route('/reorder', name: 'reorder')]
    public function reorderTaskP1Row(Request $request, TaskRepository $taskRow, AppointmentRepository $appointmentRow) {
        $cpt = 0;
        switch ($request->request->get("context")) {
            case '1':
                foreach (json_decode($request->request->get("table"), true) as $row) {
                    $task = $taskRow->find($row['id']);
                    if (!$task) { $cpt++; continue; }
                    $task->setPosition($cpt);
                    $cpt++;
                }
            break;

            case '2':
                foreach (json_decode($request->request->get("table"), true) as $row) {
                    $appt = $appointmentRow->find($row['id']);
                    if (!$appt) { $cpt++; continue; }
                    $appt->setPosition($cpt);
                    $cpt++;
                }
            break;
        }

        $this->entityManager->flush();
        return new JsonResponse([
            'data' => gettype($request->request->get("context"))
        ]);
    }
}
