<?php
// src/Twig/GlobalVariables.php

namespace App\Twig;

use App\Service\RoleService;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class GlobalVariables extends AbstractExtension implements GlobalsInterface
{
    private RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function getGlobals(): array
    {
        return [
            'userRole' => $this->roleService->getCurrentUserRole(),  // Injecte le rôle de l'utilisateur connecté
            'roles' => $this->roleService->getRoles(),
        ];
    }
}
