<?php
// src/Controller/Back/Permissions/ModifyRoleController.php

namespace App\Controller\Back\Permissions;

use App\Form\Back\Permission\ModifyRoleType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Yaml\Yaml;

class ModifyRoleController extends AbstractController
{
    /**
     * @Route("/admin/permissions/role/modifier/{roleName}", name="permission_role_edit")
     */
    public function editRole(Request $request, string $roleName): Response
    {
        // Lire le fichier roles.yaml
        $rolesFilePath = $this->getParameter('kernel.project_dir') . '/config/roles.yaml';
        $roles = Yaml::parseFile($rolesFilePath);

        // Vérifier si le rôle existe
        if (!isset($roles['roles'][$roleName])) {
            throw $this->createNotFoundException('Rôle non trouvé.');
        }

        // Créer le formulaire avec le type ModifyRoleType
        $form = $this->createForm(ModifyRoleType::class, [
            'role' => $roleName, // Passer le nom du rôle
            'label' => $roles['roles'][$roleName], // Remplir avec l'ancien label
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Mettre à jour le rôle
            $data = $form->getData();

            // Éviter d'ajouter un rôle vide
            if (empty($data['label'])) {
                $this->addFlash('warning', 'Le label ne peut pas être vide.');
                return $this->redirectToRoute('permissions_list');
            }

            // Remplacer le label du rôle existant
            $roles['roles'][$roleName] = $data['label']; // Remplace l'ancien label avec le nouveau

            // Sauvegarder les changements dans le fichier
            file_put_contents($rolesFilePath, Yaml::dump($roles));

            $this->addFlash('success', 'Rôle modifié avec succès.');

            return $this->redirectToRoute('permissions_role_list');
        }

        return $this->render('back/permissions/modify_role.html.twig', [
            'form' => $form->createView(),
            'roleName' => $roleName,
        ]);
    }
}
