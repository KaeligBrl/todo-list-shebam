<?php

namespace App\Service;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class RoleConfigService
{
    private $rolesConfig;
    private ParameterBagInterface $parameterBag;

    public function __construct(string $rolesFilePath, ParameterBagInterface $parameterBag)
    {
        $this->rolesConfig = Yaml::parseFile($rolesFilePath);
        $this->parameterBag = $parameterBag;
    }

    public function getRoutesForRole(string $role)
    {
        return $this->rolesConfig['roles'][$role]['routes'] ?? [];
    }

    public function isRouteAccessible(string $role, string $routeName): bool
    {
        $routes = $this->getRoutesForRole($role);
        return $routes[$routeName] ?? false;
    }

    public function getRoles()
    {
        return array_keys($this->rolesConfig['roles']);
    }

    public function getRouteNames()
    {
        $routeNames = [];
        foreach ($this->rolesConfig['roles'] as $role => $config) {
            if (isset($config['routes'])) {
                $routeNames = array_merge($routeNames, array_keys($config['routes']));
            }
        }
        return array_unique($routeNames);
    }

    /**
     * Récupère les rôles disponibles sous forme de tableau.
     *
     * @return array
     */
    public function getAvailableRoles(): array
    {
        $rolesData = $this->getRolesData();
        $roles = [];

        // Assurez-vous que 'roles' est un tableau
        if (isset($rolesData['roles']) && is_array($rolesData['roles'])) {
            foreach ($rolesData['roles'] as $roleConfig) {
                // Vérifiez que les clés 'label' et 'role' existent
                if (isset($roleConfig['label']) && isset($roleConfig['role']) && strpos($roleConfig['role'], 'ROLE_') === 0) {
                    $roles[$roleConfig['label']] = $roleConfig['role'];
                }
            }
        }

        return $roles;
    }    

    /**
     * Récupère les données des rôles à partir de roles.yaml.
     *
     * @return array
     */
    public function getRolesData(): array
    {
        $rolesFilePath = $this->parameterBag->get('kernel.project_dir') . '/config/roles.yaml';

        // Analyse le fichier YAML et le retourne sous forme de tableau
        return Yaml::parseFile($rolesFilePath);
    }
}