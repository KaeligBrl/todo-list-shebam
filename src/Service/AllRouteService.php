<?php
// App/Service/AllRouteService.php

namespace App\Service;

use Symfony\Component\Routing\RouterInterface;

class AllRouteService
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function getRoutesFromControllers(): array
    {
        $routes = $this->router->getRouteCollection();
        $filteredRoutes = [];

        foreach ($routes as $routeName => $route) {
            // Récupérer le contrôleur lié à la route
            $controller = $route->getDefault('_controller');

            // Vérifier si le contrôleur appartient à Controllers\Back ou Controllers\Front
            if (strpos($controller, 'App\\Controller\\Back\\') !== false || strpos($controller, 'App\\Controller\\Front\\') !== false) {
                $filteredRoutes[] = [
                    'name' => $routeName,
                    'controller' => $controller
                ];
            }
        }

        return $filteredRoutes;
    }
}