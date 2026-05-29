<?php

namespace App\Controller\Back\Role;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\NotificationContextService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteController extends AbstractController
{
    #[Route('/admin/role/supprimer/{roleName}', name: 'role_delete')]
    public function deleteRole(string $roleName, NotificationContextService $notificationContext): Response
    {
        $rolesFilePath = $this->getParameter('kernel.project_dir') . '/config/roles.yaml';

        // Charger les rôles existants
        $roles = Yaml::parseFile($rolesFilePath);

        // Vérifier si le rôle existe
        if (!isset($roles['roles'][$roleName])) {
            $this->addFlash('warning', $notificationContext->format('Administration - Rôle', 'Le rôle n\'existe pas.'));
            return $this->redirectToRoute('role_list');
        }

        // Vérifier si c'est le dernier rôle ROLE_ADMIN
        if ($roleName === 'ROLE_ADMIN') {
            $adminCount = 0;
            foreach ($roles['roles'] as $name => $properties) {
                if ($name === 'ROLE_ADMIN') {
                    $adminCount++;
                }
            }
            if ($adminCount === 1) {
                $this->addFlash('warning', $notificationContext->format('Administration - Rôle', 'Impossible de supprimer le dernier rôle administrateur.'));
                return $this->redirectToRoute('role_list');
            }
        }

        // Supprimer le rôle
        unset($roles['roles'][$roleName]);

        // Enregistrer les rôles mis à jour dans le fichier YAML
        file_put_contents($rolesFilePath, Yaml::dump($roles, 2));

        // Ajouter un message de succès
        $this->addFlash('success', $notificationContext->format('Administration - Rôle', 'Rôle supprimé avec succès.'));

        return $this->redirectToRoute('role_list');
    }

    #[Route('/admin/role/supprimer-selection', name: 'role_delete_batch', methods: ['POST'])]
    public function deleteRoleBatch(Request $request, NotificationContextService $notificationContext): Response
    {
        if (!$this->isCsrfTokenValid('delete_role_batch', $request->request->get('_token'))) {
            throw $this->createAccessDeniedException('CSRF token is invalid.');
        }

        $rolesFilePath = $this->getParameter('kernel.project_dir') . '/config/roles.yaml';
        $roles = Yaml::parseFile($rolesFilePath);

        $roleIds = $request->request->all('role_ids') ?? [];

        if (empty($roleIds)) {
            $this->addFlash('warning', $notificationContext->format('Administration - Rôles', 'Aucun rôle sélectionné.'));
            return $this->redirectToRoute('role_list');
        }

        // Compter les ROLE_ADMIN
        $adminCount = 0;
        $adminInSelection = false;
        foreach ($roles['roles'] as $name => $properties) {
            if ($name === 'ROLE_ADMIN') {
                $adminCount++;
                if (in_array('ROLE_ADMIN', $roleIds)) {
                    $adminInSelection = true;
                }
            }
        }

        // Si c'est le dernier ROLE_ADMIN et qu'il est dans la sélection, le retirer
        if ($adminInSelection && $adminCount === 1) {
            $roleIds = array_filter($roleIds, function ($roleName) {
                return $roleName !== 'ROLE_ADMIN';
            });
            $this->addFlash('warning', $notificationContext->format('Administration - Rôles', 'Le dernier rôle administrateur ne peut pas être supprimé.'));
        }

        if (empty($roleIds)) {
            return $this->redirectToRoute('role_list');
        }

        $deletedCount = 0;
        foreach ($roleIds as $roleName) {
            if (isset($roles['roles'][$roleName])) {
                unset($roles['roles'][$roleName]);
                $deletedCount++;
            }
        }

        if ($deletedCount > 0) {
            file_put_contents($rolesFilePath, Yaml::dump($roles, 2));
            $message = $deletedCount === 1 ? '1 rôle supprimé avec succès.' : $deletedCount . ' rôles supprimés avec succès.';
            $this->addFlash('success', $notificationContext->format('Administration - Rôles', $message));
        } else {
            $this->addFlash('warning', $notificationContext->format('Administration - Rôles', 'Aucun rôle trouvé pour suppression.'));
        }

        return $this->redirectToRoute('role_list');
    }
}
