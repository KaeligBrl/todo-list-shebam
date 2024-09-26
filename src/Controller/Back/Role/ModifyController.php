<?php

namespace App\Controller\Back\Role;

use App\Form\Back\Role\ModifyType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Yaml\Yaml;

class ModifyController extends AbstractController
{
    /**
     * @Route("/admin/role/modifier/{roleName}", name="role_edit")
     */
    public function editRole(Request $request, string $roleName): Response
    {
        // Lire le fichier roles.yaml
        $rolesFilePath = $this->getParameter('kernel.project_dir') . '/config/roles.yaml';
        $roles = Yaml::parseFile($rolesFilePath);

        // Récupérer le label du rôle existant
        $currentLabel = $roles['roles'][$roleName]['label'] ?? ''; // Correction ici
        $currentShowP2Button = $roles['roles'][$roleName]['show_p2_button'] ?? false;
        $currentShowP1CwToP1NwButton = $roles['roles'][$roleName]['show_task_p1_cw_to_p1_nw_button'] ?? false;
        $currentTaskModifyP1Button = $roles['roles'][$roleName]['show_task_p1_modify_button'] ?? false;
        $currentTaskDeleteP1Button = $roles['roles'][$roleName]['show_task_p1_delete_button'] ?? false;
        $switchToCw = $roles['roles'][$roleName]['show_switch_to_cw'] ?? false;

        // Créer le formulaire avec les données
        $form = $this->createForm(ModifyType::class, null, [
            'role' => $roleName,
            'label' => $currentLabel, // Remplir avec le label existant
            'show_p2_button' => $currentShowP2Button,
            'show_task_p1_cw_to_p1_nw_button' => $currentShowP1CwToP1NwButton,
            'show_task_p1_modify_button' => $currentTaskModifyP1Button,
            'show_task_p1_delete_button' => $currentTaskDeleteP1Button,
            'show_switch_to_cw' => $switchToCw
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer les données soumises
            $data = $form->getData();

            // Mettre à jour le fichier roles.yaml
            $roles['roles'][$data['role']] = [
                'label' => $data['label'],
                'show_p2_button' => $data['show_p2_button'],
                'show_task_p1_cw_to_p1_nw_button' => $data['show_task_p1_cw_to_p1_nw_button'],
                'show_task_p1_modify_button' => $data['show_task_p1_modify_button'],
                'show_task_p1_delete_button' => $data['show_task_p1_delete_button'],
                'show_switch_to_cw' => $data['show_switch_to_cw']
            ];

            // Sauvegarder les changements dans le fichier
            
            file_put_contents($rolesFilePath, Yaml::dump($roles, 4));

            $this->addFlash('success', 'Rôle modifié avec succès.');

            return $this->redirectToRoute('role_edit', ['roleName' => $roleName]);
        }

        return $this->render('back/role/modify.html.twig', [
            'form' => $form->createView(),
            'roleName' => $roleName,
        ]);
    }
}
