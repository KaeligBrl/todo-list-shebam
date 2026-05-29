<?php

namespace App\Controller\Back\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteController extends AbstractController
{
    #[Route('/admin/utilisateurs/supprimer-selection', name: 'user_delete_batch', methods: ['POST'])]
    public function deleteUsers(Request $request, EntityManagerInterface $entityManager): RedirectResponse
    {
        if (!$this->isCsrfTokenValid('delete_user_batch', (string) $request->request->get('_token'))) {
            $this->addFlash('danger', 'Token CSRF invalide.');

            return $this->redirectToRoute('user_list');
        }

        $rawIds = $request->request->all('user_ids');
        if (!is_array($rawIds)) {
            $rawIds = [];
        }

        $ids = array_values(array_unique(array_filter(array_map('intval', $rawIds), static fn (int $id): bool => $id > 0)));
        if ($ids === []) {
            $this->addFlash('warning', 'Aucun utilisateur selectionne.');

            return $this->redirectToRoute('user_list');
        }

        $users = $entityManager->getRepository(User::class)->findBy(['id' => $ids]);
        $deletedCount = 0;

        foreach ($users as $user) {
            $entityManager->remove($user);
            $deletedCount++;
        }

        $entityManager->flush();

        $this->addFlash('success', $deletedCount . " utilisateur(s) supprimé(s) de l'historique.");

        return $this->redirectToRoute('user_list');
    }
}
