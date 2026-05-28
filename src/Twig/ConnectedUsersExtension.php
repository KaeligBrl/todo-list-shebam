<?php

namespace App\Twig;

use App\Service\ConnectedUsersService;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class ConnectedUsersExtension extends AbstractExtension implements GlobalsInterface
{
    public function __construct(private readonly ConnectedUsersService $connectedUsersService)
    {
    }

    public function getGlobals(): array
    {
        return [
            'connectedUsers' => $this->connectedUsersService->getActiveUsers(),
        ];
    }
}
