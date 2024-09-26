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
        $currentShowP2Button = $roles['roles'][$roleName]['show_p2_button_in_cw'] ?? false;
        $currentShowP1CwToP1NwButton = $roles['roles'][$roleName]['show_task_p1_cw_to_p1_nw_button'] ?? false;
        $currentTaskModifyP1Button = $roles['roles'][$roleName]['show_task_p1_modify_button'] ?? false;
        $currentTaskDeleteP1Button = $roles['roles'][$roleName]['show_task_p1_delete_button'] ?? false;
        $waintinReturnInP1Cw = $roles['roles'][$roleName]['show_waiting_return_in_p1_cw'] ?? false;
        $currentShowButtonDone = $roles['roles'][$roleName]['show_button_done_in_cw'] ?? false;
        $switchToCw = $roles['roles'][$roleName]['show_switch_to_cw'] ?? false;
        $nextShowP2Button = $roles['roles'][$roleName]['show_p2_button_in_nw'] ?? false;
        $currentShowP1NwToP1CwButton = $roles['roles'][$roleName]['show_task_p1_nw_to_p1_cw_button'] ?? false;
        $nextTaskModifyP1Button = $roles['roles'][$roleName]['show_task_p1_nw_modify_button'] ?? false;
        $nextTaskDeleteP1Button = $roles['roles'][$roleName]['show_task_p1_nw_delete_button'] ?? false;
        $nextShowButtonDone = $roles['roles'][$roleName]['show_button_done_in_nw'] ?? false;
        $waintinReturnInP1Nw = $roles['roles'][$roleName]['show_waiting_return_in_p1_nw'] ?? false;

        // Créer le formulaire avec les données
        $form = $this->createForm(ModifyType::class, null, [
            'role' => $roleName,
            'label' => $currentLabel, // Remplir avec le label existant
            'show_p2_button_in_cw' => $currentShowP2Button,
            'show_task_p1_cw_to_p1_nw_button' => $currentShowP1CwToP1NwButton,
            'show_task_p1_modify_button' => $currentTaskModifyP1Button,
            'show_task_p1_delete_button' => $currentTaskDeleteP1Button,
            'show_waiting_return_in_p1_cw' => $waintinReturnInP1Cw,
            'show_button_done_in_cw' => $currentShowButtonDone,
            'show_switch_to_cw' => $switchToCw,
            'show_p2_button_in_nw' => $nextShowP2Button,
            'show_task_p1_nw_to_p1_cw_button' => $currentShowP1NwToP1CwButton,
            'show_task_p1_nw_modify_button' => $nextTaskModifyP1Button,
            'show_waiting_return_in_p1_nw' => $waintinReturnInP1Nw,
            'show_task_p1_nw_delete_button' => $nextTaskDeleteP1Button,
            'show_button_done_in_nw' => $nextShowButtonDone
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
     
            $data = $form->getData();

            $roles['roles'][$data['role']] = [
                'label' => $data['label'],
                'show_p2_button_in_cw' => $data['show_p2_button_in_cw'],
                'show_task_p1_cw_to_p1_nw_button' => $data['show_task_p1_cw_to_p1_nw_button'],
                'show_task_p1_modify_button' => $data['show_task_p1_modify_button'],
                'show_task_p1_delete_button' => $data['show_task_p1_delete_button'],
                'show_waiting_return_in_p1_cw' => $data['show_waiting_return_in_p1_cw'],
                'show_switch_to_cw' => $data['show_switch_to_cw'],
                'show_p2_button_in_nw' => $data['show_p2_button_in_nw'],
                'show_task_p1_nw_to_p1_cw_button' => $data['show_task_p1_nw_to_p1_cw_button'],
                'show_task_p1_nw_modify_button' => $data['show_task_p1_nw_modify_button'],
                'show_waiting_return_in_p1_nw' => $data['show_waiting_return_in_p1_nw'],
                'show_task_p1_nw_delete_button' =>  $data['show_task_p1_nw_delete_button'],
                'show_button_done_in_cw' => $data['show_button_done_in_cw'],
                'show_button_done_in_nw' => $data['show_button_done_in_nw'],
            ];

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
