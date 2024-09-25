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
        // Chemin vers le fichier roles.yaml
        $configFilePath = $this->getParameter('kernel.project_dir') . '/config/roles.yaml';

        // Lire le fichier et parser le contenu YAML
        $config = Yaml::parseFile($configFilePath);

        // Traiter les rôles pour s'assurer qu'ils ont une structure uniforme
        $roles = [];
        foreach ($config['roles'] ?? [] as $role => $properties) {
            if (is_array($properties)) {
                // Si les propriétés sont un tableau, ajoutez-les
                $roles[$role] = $properties;
            } else {
                // Si ce n'est pas un tableau, créez un tableau avec des valeurs par défaut
                $roles[$role] = [
                    'label' => $properties,
                    'show_p2_button' => false, // Valeur par défaut
                ];
            }
        }

        return $roles; // Retourne les rôles
    }

}
