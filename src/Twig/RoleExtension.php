<?php
// src/Twig/RoleExtension.php

namespace App\Twig;

use App\Service\RoleService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class RoleExtension extends AbstractExtension
{
    private RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_roles', [$this, 'getRoles']),
            new TwigFunction('get_current_role_name', [$this, 'getCurrentRoleName']),  // Correction du nom de la fonction
        ];
    }

    public function getRoles(): array
    {
        return $this->roleService->getRoles();
    }

    public function getCurrentRoleName(): ?string  // Implémentation de la méthode manquante
    {
        return $this->roleService->getCurrentUserRole();  // Appel à la méthode du service
    }
}
