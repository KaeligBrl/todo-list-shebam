<?php

namespace App\Controller\Front\CurrentWeek\P1;

use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiUpdateDoneController extends AbstractController
{
    #[Route('/semaine-actuelle/api/update-task/{taskId}', name: 'update_task', methods: ['POST'])]
    public function updateTask(Request $request, TaskRepository $taskRepository, EntityManagerInterface $entityManager, $taskId) {
        try {
            $data = json_decode($request->getContent(), true);

            if (!isset($data['done'])) {
                return new JsonResponse(['error' => 'Données manquantes'], 400);
            }

            $isChecked = $data['done'];

            $task = $taskRepository->find($taskId);

            if (!$task) {
                return new JsonResponse(['error' => 'Tâche introuvable'], 404);
            }
            
            $task->setDone($isChecked);
            $entityManager->flush();

            return new JsonResponse(['success' => true]);
            
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Erreur serveur: ' . $e->getMessage()], 500);
        }
    }
}
