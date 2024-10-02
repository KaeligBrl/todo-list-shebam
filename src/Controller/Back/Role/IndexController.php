<?php

namespace App\Controller\Back\Role;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class IndexController extends AbstractController
{
    private ParameterBagInterface $parameterBag;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    /**
     * @Route("/admin/role/", name="role_list")
     */
    public function index(): Response
    {
        $roles = $this->getRolesFromConfig();
        return $this->render('back/role/list.html.twig', [
            'roles' => $roles,
        ]);
    }

    private function getRolesFromConfig(): array
    {
        
        $configFilePath = $this->getParameter('kernel.project_dir') . '/config/roles.yaml';
        
        $config = Yaml::parseFile($configFilePath);

        $roles = [];
        foreach ($config['roles'] ?? [] as $role => $properties) {
            if (is_array($properties)) {
                
                $roles[$role] = $properties;
            } else {
                
                $roles[$role] = [
                    'label' => $properties,
                    'show_p2_button' => false,
                ];
            }
        }

        return $roles; // Retourne les rôles
    }

}
