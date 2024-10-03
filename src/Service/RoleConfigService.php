<?php

namespace App\Service;

use Symfony\Component\Yaml\Yaml;

class RoleConfigService
{
    private $rolesConfig;

    public function __construct(string $rolesFilePath)
    {
        $this->rolesConfig = Yaml::parseFile($rolesFilePath);
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
}