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

        $currentLabel = $roles['roles'][$roleName]['label'] ?? '';

        // Current Week -> P1
        $currentShowP2Button = $roles['roles'][$roleName]['p2_button_in_p1_cw'] ?? false;
        $currentShowP1CwToP1NwButton = $roles['roles'][$roleName]['task_p1_cw_to_p1_nw_button'] ?? false;
        $currentTaskModifyP1Button = $roles['roles'][$roleName]['task_p1_modify_button'] ?? false;
        $currentTaskDeleteP1Button = $roles['roles'][$roleName]['task_p1_delete_button'] ?? false;
        $waintinReturnInP1Cw = $roles['roles'][$roleName]['waiting_return_in_p1_cw'] ?? false;
        
        // Current Week -> P2
        $currentP2ShowP1Button = $roles['roles'][$roleName]['p1_button_in_p2_cw'] ?? false;
        $currentTaskModifyP2Button = $roles['roles'][$roleName]['task_p2_modify_button'] ?? false;
        $currentTaskDeleteP2Button = $roles['roles'][$roleName]['task_p2_delete_button'] ?? false;
        $waintinReturnInP2Cw = $roles['roles'][$roleName]['waiting_return_in_p2_cw'] ?? false;
        $currentP2CwToP1NwButton = $roles['roles'][$roleName]['task_p2_cw_to_p1_nw_button'] ?? false;

        // Current Week -> Wainting Return
        $waintingReturnToP1 = $roles['roles'][$roleName]['wainting_return_to_p1'] ?? false;
        $waintingReturnToP2 = $roles['roles'][$roleName]['wainting_return_to_p2'] ?? false;
        $waintingReturnFromCwToNw = $roles['roles'][$roleName]['wainting_return_from_cw_to_nw'] ?? false;
        $waintingReturnModifyCw = $roles['roles'][$roleName]['wainting_return_modify_cw'] ?? false;
        $waintingReturnDeleteCw = $roles['roles'][$roleName]['wainting_return_delete_cw'] ?? false;

        // Next WEEK -> P1
        $waintinReturnInP1Nw = $roles['roles'][$roleName]['waiting_return_in_p1_nw'] ?? false;
        $taskP1ToP2Nw = $roles['roles'][$roleName]['task_p1_to_p2_nw'] ?? false;
        $taskP1NwToP1CwButton = $roles['roles'][$roleName]['task_p1_nw_to_p1_cw_button'] ?? false;
        $taskP1NwToModifyButton = $roles['roles'][$roleName]['task_p1_modify_nw'] ?? false;
        $taskP1NwToDeleteButton = $roles['roles'][$roleName]['task_p1_delete_nw'] ?? false;
        // Next WEEK -> P2
        // Next WEEK -> Wainting Return

        // Global
        $buttonDone = $roles['roles'][$roleName]['button_done'] ?? false;
        $addTask = $roles['roles'][$roleName]['add_task'] ?? false;
        $reorderTask = $roles['roles'][$roleName]['reorder_task'] ?? false;
        $generateArchiveTask = $roles['roles'][$roleName]['generate_archive_task'] ?? false;
        $addWaintingReturn = $roles['roles'][$roleName]['add_wainting_return'] ?? false;

        $form = $this->createForm(ModifyType::class, null, [
            'role' => $roleName,
            'label' => $currentLabel,
            // Current Week -> P1
            'p2_button_in_p1_cw' => $currentShowP2Button,
            'task_p1_cw_to_p1_nw_button' => $currentShowP1CwToP1NwButton,
            'task_p1_modify_button' => $currentTaskModifyP1Button,
            'task_p1_delete_button' => $currentTaskDeleteP1Button,
            'waiting_return_in_p1_cw' => $waintinReturnInP1Cw,
            // Current Week -> P2
            'p1_button_in_p2_cw' => $currentP2ShowP1Button,
            'task_p2_modify_button' => $currentTaskModifyP2Button,
            'task_p2_delete_button' => $currentTaskDeleteP2Button,
            'waiting_return_in_p2_cw' => $waintinReturnInP2Cw,
            'task_p2_cw_to_p1_nw_button' => $currentP2CwToP1NwButton,
            // Current Week -> Wainting Return
            'wainting_return_to_p1'=> $waintingReturnToP1,
            'wainting_return_to_p2' => $waintingReturnToP2,
            'wainting_return_from_cw_to_nw' => $waintingReturnFromCwToNw,
            'wainting_return_modify_cw' => $waintingReturnModifyCw,
            'wainting_return_delete_cw' => $waintingReturnDeleteCw,
            // Next WEEK -> P1
            'waiting_return_in_p1_nw' => $waintinReturnInP1Nw,
            'task_p1_to_p2_nw' => $taskP1ToP2Nw,
            'task_p1_nw_to_p1_cw_button' => $taskP1NwToP1CwButton,
            'task_p1_modify_nw' => $taskP1NwToModifyButton,
            'task_p1_delete_nw' => $taskP1NwToDeleteButton,
            // Next WEEK -> P2
            // Next WEEK -> Wainting Return
            // Global
            'reorder_task' => $reorderTask,
            'add_task' => $addTask,
            'generate_archive_task' => $generateArchiveTask,
            'button_done' => $buttonDone,
            'add_wainting_return' => $addWaintingReturn
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
     
            $data = $form->getData();

            $roles['roles'][$data['role']] = [
                'label' => $data['label'],
                // Current Week -> P1
                'p2_button_in_p1_cw' => $data['p2_button_in_p1_cw'],
                'task_p1_cw_to_p1_nw_button' => $data['task_p1_cw_to_p1_nw_button'],
                'task_p1_modify_button' => $data['task_p1_modify_button'],
                'task_p1_delete_button' => $data['task_p1_delete_button'],
                'waiting_return_in_p1_cw' => $data['waiting_return_in_p1_cw'],
                // Current Week -> P2
                'p1_button_in_p2_cw' => $data['p1_button_in_p2_cw'],
                'task_p2_modify_button' => $data['task_p2_modify_button'],
                'task_p2_delete_button' => $data['task_p2_delete_button'],
                'waiting_return_in_p2_cw' => $data['waiting_return_in_p2_cw'],
                'task_p2_cw_to_p1_nw_button' => $data['task_p2_cw_to_p1_nw_button'],
                // Current Week -> Wainting Return
                'wainting_return_to_p1' => $data['wainting_return_to_p1'],
                'wainting_return_to_p2' => $data['wainting_return_to_p2'],
                'wainting_return_from_cw_to_nw' => $data['wainting_return_from_cw_to_nw'],
                'wainting_return_modify_cw' => $data['wainting_return_modify_cw'],
                'wainting_return_delete_cw' => $data['wainting_return_delete_cw'],
                // Next WEEK -> P1
                'waiting_return_in_p1_nw' => $data['waiting_return_in_p1_nw'],
                'task_p1_to_p2_nw' => $data['task_p1_to_p2_nw'],
                'task_p1_nw_to_p1_cw_button' => $data['task_p1_nw_to_p1_cw_button'],
                'task_p1_modify_nw' => $data['task_p1_modify_nw'],
                'task_p1_delete_nw' => $data['task_p1_delete_nw'],
                // Next WEEK -> P2
                // Next WEEK -> Wainting Return                
                // Global
                'button_done' => $data['button_done'],
                'reorder_task' => $data['reorder_task'],
                'add_task' => $data['add_task'],
                'generate_archive_task' => $data['generate_archive_task'],
                'add_wainting_return' => $data['add_wainting_return']
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
