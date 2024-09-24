<?php
// src/Controller/Back/Permissions/RoleController.php

namespace App\Controller\Back\Permissions;

use Symfony\Component\Yaml\Yaml;
use App\Form\Back\Permission\AddRoleType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteRoleController extends AbstractController
{
    /**
     * @Route("/admin/permissions/role/supprimer/{roleName}", name="permission_role_delete")
     */
    public function deleteRole(string $roleName): Response
    {
        $rolesFilePath = $this->getParameter('kernel.project_dir') . '/config/roles.yaml';

        // Charger les rôles existants
        $roles = Yaml::parseFile($rolesFilePath);

        // Vérifier si le rôle existe
        if (!isset($roles['roles'][$roleName])) {
            $this->addFlash('warning', 'Le rôle n\'existe pas.');
            return $this->redirectToRoute('permissions_role_list'); // Redirigez vers la liste des rôles
        }

        // Supprimer le rôle
        unset($roles['roles'][$roleName]);

        // Enregistrer les rôles mis à jour dans le fichier YAML
        file_put_contents($rolesFilePath, Yaml::dump($roles, 2));

        // Ajouter un message de succès
        $this->addFlash('success', 'Rôle supprimé avec succès.');

        return $this->redirectToRoute('permissions_role_list'); // Redirigez vers la liste des rôles
    }

}
