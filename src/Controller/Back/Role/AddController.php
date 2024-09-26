<?php
// src/Controller/Back/Role/RController.php

namespace App\Controller\Back\Role;

use Symfony\Component\Yaml\Yaml;
use App\Form\Back\Role\AddType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddController extends AbstractController
{
    /**
     * @Route("/admin/permissions/role/ajouter", name="role_add")
     */
    public function addRole(Request $request): Response
    {
        $form = $this->createForm(AddType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $newRole = $data['role'];
            $roleLabel = $data['label']; // Nouveau champ pour le label du rôle

            // Valider le format du rôle (il doit commencer par 'ROLE_')
            if (strpos($newRole, 'ROLE_') !== 0) {
                $this->addFlash('warning', 'Le rôle doit commencer par "ROLE_".');
                return $this->redirectToRoute('role_add');
            }

            // Chemin vers le fichier roles.yaml
            $rolesFilePath = $this->getParameter('kernel.project_dir') . '/config/roles.yaml';

            // Lire les rôles existants dans le fichier YAML
            $rolesConfig = Yaml::parseFile($rolesFilePath);

            // Si le rôle n'existe pas déjà, on l'ajoute
            if (!array_key_exists($newRole, $rolesConfig['roles'])) {
                // Modifier la structure pour correspondre à { label: nomdulabel }
                $rolesConfig['roles'][$newRole] = [
                    'label' => $roleLabel,
                ];

                // Sauvegarder les nouveaux rôles dans roles.yaml
                file_put_contents($rolesFilePath, Yaml::dump($rolesConfig, 2));

                $this->addFlash('success', 'Le rôle a été ajouté avec succès !');
            } else {
                $this->addFlash('warning', 'Ce rôle existe déjà.');
            }

            return $this->redirectToRoute('role_add');
        }

        return $this->render('back/permissions/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
