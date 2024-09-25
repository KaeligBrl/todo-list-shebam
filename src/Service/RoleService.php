<?php

// src/Service/RoleService.php

namespace App\Service;

use Symfony\Component\Security\Core\Security;
use Symfony\Component\Yaml\Yaml;

class RoleService
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function getRoles(): array
    {
        $rolesFilePath = $this->getRolesFilePath();
        return Yaml::parseFile($rolesFilePath)['roles'] ?? [];
    }

    public function getCurrentUserRole(): ?string
    {
        $user = $this->security->getUser();

        if ($user) {
            $roles = $user->getRoles(); // Récupère les rôles de l'utilisateur
            return $roles[0] ?? null;    // On retourne le premier rôle trouvé
        }

        return null; // Retourne null si aucun utilisateur connecté
    }

    private function getRolesFilePath(): string
    {
        return __DIR__ . '/../../config/roles.yaml';
    }
}