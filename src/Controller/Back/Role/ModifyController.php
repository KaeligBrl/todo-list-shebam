<?php

namespace App\Controller\Back\Role;


use App\Service\RouteService;
use Symfony\Component\Yaml\Yaml;
use App\Form\Back\Role\ModifyType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\NotificationContextService;

class ModifyController extends AbstractController
{
    private $routeService;

    public function __construct(RouteService $routeService) {
        $this->routeService = $routeService;
    }
    #[Route('/admin/role/modifier/{roleName}', name: 'role_edit')]
    public function editRole(Request $request, string $roleName, NotificationContextService $notificationContext): Response
    {
        // Lire le fichier roles.yaml
        $rolesFilePath = $this->getParameter('kernel.project_dir') . '/config/roles.yaml';
        $roles = Yaml::parseFile($rolesFilePath);

        $currentLabel = $roles['roles'][$roleName]['label'] ?? '';

        // Current Week -> P1
        $currentweekAddTaskBtn = $roles['roles'][$roleName]['add_task_cw'] ?? false;
        $currentShowP2Button = $roles['roles'][$roleName]['p2_button_in_p1_cw'] ?? false;
        $currentShowP1CwToP1NwButton = $roles['roles'][$roleName]['task_p1_cw_to_p1_nw_button'] ?? false;
        $currentTaskModifyP1Button = $roles['roles'][$roleName]['task_p1_modify_button'] ?? false;
        $currentTaskDeleteP1Button = $roles['roles'][$roleName]['task_p1_delete_button'] ?? false;
        
        // Current Week -> P2
        $currentP2ShowP1Button = $roles['roles'][$roleName]['p1_button_in_p2_cw'] ?? false;
        $currentTaskModifyP2Button = $roles['roles'][$roleName]['task_p2_modify_button'] ?? false;
        $currentTaskDeleteP2Button = $roles['roles'][$roleName]['task_p2_delete_button'] ?? false;
        $currentP2CwToP1NwButton = $roles['roles'][$roleName]['task_p2_cw_to_p1_nw_button'] ?? false;

        // Current Week -> Appointment
        $appointmentCwToNw = $roles['roles'][$roleName]['appointment_cw_to_nw'] ?? false;
        $appointmentModifyCw = $roles['roles'][$roleName]['appointment_modify_cw'] ?? false;
        $appointmentDeleteCw = $roles['roles'][$roleName]['appointment_delete_cw'] ?? false;

        // Next WEEK -> P1
        $taskP1ToP2Nw = $roles['roles'][$roleName]['task_p1_to_p2_nw'] ?? false;
        $taskP1NwToP1CwButton = $roles['roles'][$roleName]['task_p1_nw_to_p1_cw_button'] ?? false;
        $taskP1NwToModifyButton = $roles['roles'][$roleName]['task_p1_modify_nw'] ?? false;
        $taskP1NwToDeleteButton = $roles['roles'][$roleName]['task_p1_delete_nw'] ?? false;

        // Next WEEK -> P2
        $taskP2ToP1Nw = $roles['roles'][$roleName]['task_p2_to_p1_nw'] ?? false;
        $taskP2ModifyNw= $roles['roles'][$roleName]['task_p2_modify_nw'] ?? false;
        $taskP2DeleteNw = $roles['roles'][$roleName]['task_p2_delete_nw'] ?? false;
        $taskP2NwToP2CwButton = $roles['roles'][$roleName]['task_p2_nw_to_p2_cw_button'] ?? false;

        // Current Week -> Appointment
        $appointmentNwToCw = $roles['roles'][$roleName]['appointment_nw_to_cw'] ?? false;
        $appointmentModifyNw = $roles['roles'][$roleName]['appointment_modify_nw'] ?? false;
        $appointmentDeleteNw = $roles['roles'][$roleName]['appointment_delete_nw'] ?? false;
        
        // Global
        $buttonDone = $roles['roles'][$roleName]['button_done'] ?? false;
        $addTask = $roles['roles'][$roleName]['add_task'] ?? false;
        $reorderTask = $roles['roles'][$roleName]['reorder_task'] ?? false;
        $generateArchiveTask = $roles['roles'][$roleName]['generate_archive_task'] ?? false;
        $btnSwitchNwToNw = $roles['roles'][$roleName]['show_switch_to_cw'] ?? false;

        // Ideabam
        $addIdeabam = $roles['roles'][$roleName]['add_ideabam'] ?? false;
        $modifyIdeabam = $roles['roles'][$roleName]['modify_ideabam'] ?? false;
        $deleteIdeabam = $roles['roles'][$roleName]['delete_ideabam'] ?? false;

        $routes = $this->routeService->getRoutesFromControllers();

        $form = $this->createForm(ModifyType::class, null, [
            'role' => $roleName,
            'routes' => $this->routeService->getRoutesFromControllers(),
            'label' => $currentLabel,
            // Current Week -> P1
            'add_task_cw' => $currentweekAddTaskBtn,
            'p2_button_in_p1_cw' => $currentShowP2Button,
            'task_p1_cw_to_p1_nw_button' => $currentShowP1CwToP1NwButton,
            'task_p1_modify_button' => $currentTaskModifyP1Button,
            'task_p1_delete_button' => $currentTaskDeleteP1Button,
            // Current Week -> P2
            'p1_button_in_p2_cw' => $currentP2ShowP1Button,
            'task_p2_modify_button' => $currentTaskModifyP2Button,
            'task_p2_delete_button' => $currentTaskDeleteP2Button,
            'task_p2_cw_to_p1_nw_button' => $currentP2CwToP1NwButton,
            // Current Week -> Appointment
            'appointment_cw_to_nw' => $appointmentCwToNw,
            'appointment_modify_cw' => $appointmentModifyCw,
            'appointment_delete_cw' => $appointmentDeleteCw,
            // Next WEEK -> P1
            'task_p1_to_p2_nw' => $taskP1ToP2Nw,
            'task_p1_nw_to_p1_cw_button' => $taskP1NwToP1CwButton,
            'task_p1_modify_nw' => $taskP1NwToModifyButton,
            'task_p1_delete_nw' => $taskP1NwToDeleteButton,
            // Next WEEK -> P2
            'task_p2_to_p1_nw' => $taskP2ToP1Nw,
            'task_p2_modify_nw' => $taskP2ModifyNw,
            'task_p2_delete_nw' => $taskP2DeleteNw,
            'task_p2_nw_to_p2_cw_button' => $taskP2NwToP2CwButton,
            // Next Week -> Appointment
            'appointment_nw_to_cw' => $appointmentNwToCw,
            'appointment_modify_nw' => $appointmentModifyNw,
            'appointment_delete_nw' => $appointmentDeleteNw,
            // Global
            'reorder_task' => $reorderTask,
            'add_task' => $addTask,
            'generate_archive_task' => $generateArchiveTask,
            'button_done' => $buttonDone,
            'show_switch_to_cw' => $btnSwitchNwToNw,
            // Ideabam
            'add_ideabam' => $addIdeabam,
            'modify_ideabam' => $modifyIdeabam, 
            'delete_ideabam' => $deleteIdeabam,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
     
            $data = $form->getData();
            
            // Supposons que vous ayez déjà récupéré toutes les données de $data et $allRouteService
            $roles['roles'][$data['role']] = [
                'label' => $data['label'],
                // Current Week -> P1
                'add_task_cw' => $data['add_task_cw'],
                'p2_button_in_p1_cw' => $data['p2_button_in_p1_cw'],
                'task_p1_cw_to_p1_nw_button' => $data['task_p1_cw_to_p1_nw_button'],
                'task_p1_modify_button' => $data['task_p1_modify_button'],
                'task_p1_delete_button' => $data['task_p1_delete_button'],
                // Current Week -> P2
                'p1_button_in_p2_cw' => $data['p1_button_in_p2_cw'],
                'task_p2_modify_button' => $data['task_p2_modify_button'],
                'task_p2_delete_button' => $data['task_p2_delete_button'],
                'task_p2_cw_to_p1_nw_button' => $data['task_p2_cw_to_p1_nw_button'],
                // Current Week -> Appointment
                'appointment_cw_to_nw' => $data['appointment_cw_to_nw'],
                'appointment_modify_cw' => $data['appointment_modify_cw'],
                'appointment_delete_cw' => $data['appointment_delete_cw'],
                // Next WEEK -> P1
                'task_p1_to_p2_nw' => $data['task_p1_to_p2_nw'],
                'task_p1_nw_to_p1_cw_button' => $data['task_p1_nw_to_p1_cw_button'],
                'task_p1_modify_nw' => $data['task_p1_modify_nw'],
                'task_p1_delete_nw' => $data['task_p1_delete_nw'],
                // Next WEEK -> P2
                'task_p2_to_p1_nw' => $data['task_p2_to_p1_nw'],
                'task_p2_modify_nw' => $data['task_p2_modify_nw'],
                'task_p2_delete_nw' => $data['task_p2_delete_nw'],
                'task_p2_nw_to_p2_cw_button' => $data['task_p2_nw_to_p2_cw_button'],


                // Next  -> Appointment
                'appointment_nw_to_cw' => $data['appointment_nw_to_cw'],
                'appointment_modify_nw' => $data['appointment_modify_nw'],
                'appointment_delete_nw' => $data['appointment_delete_nw'],

                // Global
                'button_done' => $data['button_done'],
                'reorder_task' => $data['reorder_task'],
                'add_task' => $data['add_task'],
                'generate_archive_task' => $data['generate_archive_task'],
                'show_switch_to_cw' => $data['show_switch_to_cw'],

                // Ideabam
                'add_ideabam' => $data['add_ideabam'],
                'modify_ideabam' => $data['modify_ideabam'],
                'delete_ideabam' => $data['delete_ideabam'],
            ];

            // Récupérer les données de chaque route
            foreach ($this->routeService->getRoutesFromControllers() as $route) {

                // Vérifiez si la route existe dans $data et ajoutez la valeur correspondante
                $routeKey = '' . $route['name'];
                if (isset($data[$routeKey])) {
                    // Ajoutez la donnée pour chaque route dans le tableau des rôles
                    $roles['roles'][$data['role']]['routes'][$route['name']] = $data[$routeKey];
                }
            }

            file_put_contents($rolesFilePath, Yaml::dump($roles, 4));

            $this->addFlash('success', $notificationContext->format('Administration - Rôle', 'Rôle modifié avec succès.'));

            return $this->redirectToRoute('role_edit', ['roleName' => $roleName]);
        }


        return $this->render('back/role/modify.html.twig', [
            'form' => $form->createView(),
            'roleName' => $roleName,
            'routes' => $routes,
        ]);
    }
}
