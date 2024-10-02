<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class RouteService
{
    private RouterInterface $router;
    private ParameterBagInterface $parameterBag; // Changer le type ici

    public function __construct(RouterInterface $router, ParameterBagInterface $parameterBag)
    {
        $this->router = $router;
        $this->parameterBag = $parameterBag; // Initialiser le ParameterBagInterface
    }

    /**
     * Récupère les routes définies dans les contrôleurs Back et Front.
     *
     * @return array Liste des routes avec leur nom, contrôleur et statut.
     */
    public function getRoutesFromControllers(): array
    {
        $routes = $this->router->getRouteCollection();
        $filteredRoutes = [];
        $rolesData = $this->getRolesData();
        $definedRoutes = [];

        foreach ($rolesData['roles'] as $roleConfig) {
            if (isset($roleConfig['routes'])) {
                $definedRoutes = array_merge($definedRoutes, $roleConfig['routes']);
            }
        }

        foreach ($routes as $routeName => $route) {
            $controller = $route->getDefault('_controller');
            if ($this->isBackOrFrontController($controller)) {
                $routeStatus = isset($definedRoutes[$routeName]) ? $definedRoutes[$routeName] : false;
                $filteredRoutes[] = [
                    'name' => $routeName,
                    'controller' => $controller,
                    'status' => $routeStatus,
                ];
            }
        }

        return $filteredRoutes;
    }


    /**
     * Vérifie si le contrôleur appartient aux namespaces Back ou Front.
     *
     * @param string $controller
     * @return bool
     */
    private function isBackOrFrontController(string $controller): bool
    {
        return strpos($controller, 'App\\Controller\\Back\\') !== false ||
            strpos($controller, 'App\\Controller\\Front\\') !== false;
    }

    public function getRolesData(): array
    {
        // Chemin vers le fichier roles.yaml
        $rolesFilePath = $this->parameterBag->get('kernel.project_dir') . '/config/roles.yaml';

        // Analyse le fichier YAML et le retourne sous forme de tableau
        $roles = Yaml::parseFile($rolesFilePath);

        return $roles;
    }
}
