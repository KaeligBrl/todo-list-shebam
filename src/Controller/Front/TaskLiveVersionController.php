<?php

namespace App\Controller\Front;

use App\Service\TaskLiveVersionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Attribute\Route;

class TaskLiveVersionController extends AbstractController
{
    #[Route('/api/front/task/live-version', name: 'task_live_version', methods: ['GET'])]
    public function __invoke(TaskLiveVersionService $taskLiveVersionService): JsonResponse
    {
        $response = $this->json([
            'version' => $taskLiveVersionService->getVersion(),
            'last_change' => $taskLiveVersionService->getLastChange(),
            'draft_version' => $taskLiveVersionService->getDraftVersion(),
            'drafts' => $taskLiveVersionService->getDrafts(),
            'now' => (int) floor(microtime(true) * 1000),
        ]);

        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        $response->headers->set('Pragma', 'no-cache');

        return $response;
    }

    #[Route('/api/front/task/live-stream', name: 'task_live_stream', methods: ['GET'])]
    public function streamUpdates(TaskLiveVersionService $taskLiveVersionService): StreamedResponse
    {
        $response = new StreamedResponse(function () use ($taskLiveVersionService): void {
            ignore_user_abort(true);
            @set_time_limit(0);

            $lastVersion = $taskLiveVersionService->getVersion();
            $lastDraftVersion = $taskLiveVersionService->getDraftVersion();
            $lastDraftScopes = [];
            $startedAt = time();

            echo "retry: 5000\n\n";
            @ob_flush();
            flush();

            $initialDrafts = $taskLiveVersionService->getDrafts();
            foreach ($initialDrafts as $scope => $draft) {
                $lastDraftScopes[(string) $scope] = true;

                echo "event: task-draft\n";
                echo 'data: ' . (string) json_encode([
                    'draft_version' => $lastDraftVersion,
                    'scope' => (string) $scope,
                    'draft' => $draft,
                    'now' => (int) floor(microtime(true) * 1000),
                ], JSON_UNESCAPED_SLASHES) . "\n\n";
                @ob_flush();
                flush();
            }

            while (!connection_aborted() && (time() - $startedAt) < 55) {
                clearstatcache(true);

                $version = $taskLiveVersionService->getVersion();
                if ($version > $lastVersion) {
                    $lastVersion = $version;

                    $payload = [
                        'version' => $version,
                        'last_change' => $taskLiveVersionService->getLastChange(),
                        'now' => (int) floor(microtime(true) * 1000),
                    ];

                    echo "event: task-update\n";
                    echo 'data: ' . (string) json_encode($payload, JSON_UNESCAPED_SLASHES) . "\n\n";
                    @ob_flush();
                    flush();
                }

                $draftVersion = $taskLiveVersionService->getDraftVersion();
                if ($draftVersion > $lastDraftVersion) {
                    $lastDraftVersion = $draftVersion;
                    $activeDrafts = $taskLiveVersionService->getDrafts();

                    foreach ($activeDrafts as $scope => $draft) {
                        $lastDraftScopes[(string) $scope] = true;

                        echo "event: task-draft\n";
                        echo 'data: ' . (string) json_encode([
                            'draft_version' => $draftVersion,
                            'scope' => (string) $scope,
                            'draft' => $draft,
                            'now' => (int) floor(microtime(true) * 1000),
                        ], JSON_UNESCAPED_SLASHES) . "\n\n";
                        @ob_flush();
                        flush();
                    }

                    foreach (array_keys($lastDraftScopes) as $scope) {
                        if (isset($activeDrafts[$scope])) {
                            continue;
                        }

                        echo "event: task-draft-clear\n";
                        echo 'data: ' . (string) json_encode([
                            'draft_version' => $draftVersion,
                            'scope' => (string) $scope,
                            'now' => (int) floor(microtime(true) * 1000),
                        ], JSON_UNESCAPED_SLASHES) . "\n\n";
                        @ob_flush();
                        flush();

                        unset($lastDraftScopes[$scope]);
                    }
                }

                usleep(1000000);
            }

            echo ": close\n\n";
            @ob_flush();
            flush();
        });

        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        $response->headers->set('Connection', 'keep-alive');
        $response->headers->set('X-Accel-Buffering', 'no');

        return $response;
    }
}
