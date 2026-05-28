<?php

namespace App\Controller\Front\ConnectedUsers;

use App\Service\ConnectedUsersService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends AbstractController
{
    #[Route('/api/front/connected-users', name: 'front_connected_users_active', methods: ['GET'])]
    public function __invoke(ConnectedUsersService $connectedUsersService): JsonResponse
    {
        if (!$this->getUser()) {
            return new JsonResponse(['users' => []], JsonResponse::HTTP_UNAUTHORIZED);
        }

        return new JsonResponse([
            'users' => $connectedUsersService->getActiveUsers(),
        ]);
    }
}
