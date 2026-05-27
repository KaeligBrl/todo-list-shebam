<?php

namespace App\Controller\Front;

use App\Service\TaskLiveVersionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class TaskLiveVersionController extends AbstractController
{
    #[Route('/api/front/task/live-version', name: 'task_live_version', methods: ['GET'])]
    public function __invoke(TaskLiveVersionService $taskLiveVersionService): JsonResponse
    {
        $response = $this->json([
            'version' => $taskLiveVersionService->getVersion(),
            'now' => (int) floor(microtime(true) * 1000),
        ]);

        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        $response->headers->set('Pragma', 'no-cache');

        return $response;
    }
}
