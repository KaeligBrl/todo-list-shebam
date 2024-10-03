<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use App\Service\RoleConfigService;

class RouteAccessListener
{
    private $security;
    private $roleConfigService;

    // Liste des routes accessibles sans connexion
    private $publicRoutes = [
        'register',
        'register_message_success',
        'app_forgot_password_request',
        'app_logout',
        'app_check_email',
        'app_reset_password',
        'home',
    ];

    public function __construct(Security $security, RoleConfigService $roleConfigService)
    {
        $this->security = $security;
        $this->roleConfigService = $roleConfigService;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        // Récupérer l'utilisateur connecté
        $user = $this->security->getUser();

        // Récupérer la route demandée
        $routeName = $event->getRequest()->attributes->get('_route');

        // Vérifiez si le nom de la route n'est pas null
        if ($routeName === null) {
            return; // Ou vous pouvez lancer une exception si nécessaire
        }

        // Vérifiez si la route est publique
        if (in_array($routeName, $this->publicRoutes)) {
            return; // Permettre l'accès sans vérification
        }

        // Si l'utilisateur n'est pas connecté, refusez l'accès
        if (!$user) {
            throw new AccessDeniedHttpException('Accès refusé');
        }

        // Récupérer le rôle de l'utilisateur
        $role = $user->getRoles()[0]; // Exemple de récupération du rôle principal

        // Vérifier si la route est accessible selon le rôle dans le fichier roles.yaml
        if (!$this->roleConfigService->isRouteAccessible($role, $routeName)) {
            throw new AccessDeniedHttpException('Accès refusé');
        }
    }
}
