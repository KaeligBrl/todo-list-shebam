<?php

namespace App\Controller\Front;

use App\Entity\User;
use App\Service\TaskLiveVersionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class TaskLiveDraftController extends AbstractController
{
    #[Route('/api/front/task/live-draft', name: 'task_live_draft', methods: ['POST'])]
    public function save(Request $request, TaskLiveVersionService $taskLiveVersionService): JsonResponse
    {
        $payload = $request->toArray();
        $scope = trim((string) ($payload['scope'] ?? ''));

        if ($scope === '') {
            return $this->json(['success' => false, 'message' => 'Scope missing'], 400);
        }

        $draft = isset($payload['draft']) && is_array($payload['draft']) ? $payload['draft'] : [];
        $tabId = isset($payload['tab_id']) ? trim((string) $payload['tab_id']) : null;
        $user = $this->getUser();

        $taskLiveVersionService->recordDraft($scope, $draft, $user instanceof User ? $user : null, $tabId !== '' ? $tabId : null);

        return $this->json(['success' => true]);
    }

    #[Route('/api/front/task/live-draft', name: 'task_live_draft_clear', methods: ['DELETE'])]
    public function clear(Request $request, TaskLiveVersionService $taskLiveVersionService): JsonResponse
    {
        $payload = [];

        try {
            $payload = $request->toArray();
        } catch (\Throwable) {
            $payload = [];
        }

        $scope = trim((string) ($payload['scope'] ?? $request->query->get('scope', '')));

        if ($scope !== '') {
            $taskLiveVersionService->clearDraft($scope);
        }

        return $this->json(['success' => true]);
    }
}