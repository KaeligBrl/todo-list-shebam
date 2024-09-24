<?php

namespace App\Controller\Back\Permissions;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class RoleController extends AbstractController
{
    private ParameterBagInterface $parameterBag;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    /**
     * @Route("/admin/permissions/role/", name="permissions_role_list")
     */
    public function index(): Response
    {
        $roles = $this->getRolesFromConfig();
        return $this->render('back/permissions/role.html.twig', [
            'roles' => $roles,
        ]);
    }

    private function getRolesFromConfig(): array
    {
        // Chemin vers le fichier roles.yaml
        $configFilePath = $this->getParameter('kernel.project_dir') . '/config/roles.yaml';

        // Lire le fichier et parser le contenu YAML
        $config = Yaml::parseFile($configFilePath);

        return $config['roles'] ?? []; // Retourne les rôles
    }
}
