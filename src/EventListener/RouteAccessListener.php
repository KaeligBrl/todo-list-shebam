<?php

namespace App\EventListener;

use Symfony\Component\Yaml\Yaml;
use App\Service\RoleConfigService;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class RouteAccessListener
{
    private $security;
    private $roleConfigService;
    private ParameterBagInterface $parameterBag;

    public function __construct(Security $security, RoleConfigService $roleConfigService, ParameterBagInterface $parameterBag)
    {
        $this->security = $security;
        $this->roleConfigService = $roleConfigService;
        $this->parameterBag = $parameterBag;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        // Récupérer l'utilisateur connecté
        $user = $this->security->getUser();
        if (!$user) {
            return;
        }

        // Récupérer le rôle de l'utilisateur
        $role = $user->getRoles()[0]; // Exemple de récupération du rôle principal

        // Récupérer la route demandée
        $routeName = $event->getRequest()->attributes->get('_route');

        // Vérifiez si le nom de la route n'est pas null
        if ($routeName === null) {
            return; // Ou vous pouvez lancer une exception si nécessaire
        }

        // Vérifier si la route est accessible selon le rôle dans le fichier roles.yaml
        if (!$this->roleConfigService->isRouteAccessible($role, $routeName)) {
            throw new AccessDeniedHttpException('Accès refusé');
        }

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

    /**
     * Récupère les rôles disponibles sous forme de tableau.
     *
     * @return array
     */
    public function getAvailableRoles(): array
    {
        $rolesData = $this->getRolesData();
        $roles = [];
        foreach ($rolesData['roles'] as $roleConfig) {
            if (isset($roleConfig['label']) && isset($roleConfig['role'])) {
                $roles[$roleConfig['label']] = $roleConfig['role'];
            }
        }
        return $roles;
    }

}