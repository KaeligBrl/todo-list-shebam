<?php
// App/Service/AllRouteService.php

namespace App\Service;

use Symfony\Component\Routing\RouterInterface;

class AllRouteService
{
    private RouterInterface $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * Récupère toutes les routes des contrôleurs dans les namespaces Back et Front.
     *
     * @return array Un tableau contenant le nom de la route et le contrôleur associé.
     */
    public function getRoutesFromControllers(): array
    {
        // Récupérer toutes les routes
        $routes = $this->router->getRouteCollection();
        $filteredRoutes = [];

        // Filtrer les routes pour ne garder que celles des contrôleurs Back et Front
        foreach ($routes as $routeName => $route) {
            // Récupérer le contrôleur lié à la route
            $controller = $route->getDefault('_controller');

            // Vérifier si le contrôleur appartient à Controllers\Back ou Controllers\Front
            if (
                strpos($controller, 'App\\Controller\\Back\\') !== false ||
                strpos($controller, 'App\\Controller\\Front\\') !== false
            ) {
                $filteredRoutes[] = [
                    'name' => $routeName,
                    'controller' => $controller
                ];
            }
        }

        return $filteredRoutes;
    }
}
