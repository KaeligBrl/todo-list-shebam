<?php

namespace App\Controller\Back\Download;

use App\Entity\File;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteController extends AbstractController
{
    #[Route('/admin/telechargements/supprimer-selection', name: 'delete_download_batch', methods: ['POST'])]
    public function deleteBatch(Request $request, EntityManagerInterface $entityManager): RedirectResponse
    {
        if (!$this->isCsrfTokenValid('delete_download_batch', (string) $request->request->get('_token'))) {
            $this->addFlash('danger', 'Token CSRF invalide.');

            return $this->redirectToRoute('download_list');
        }

        $rawIds = $request->request->all('download_ids');
        if (!is_array($rawIds)) {
            $rawIds = [];
        }

        $ids = array_values(array_unique(array_filter(array_map('intval', $rawIds), static fn (int $id): bool => $id > 0)));
        if ($ids === []) {
            $this->addFlash('warning', 'Aucun export selectionne.');

            return $this->redirectToRoute('download_list');
        }

        $downloads = $entityManager->getRepository(File::class)->findBy(['id' => $ids]);
        $deletedCount = 0;

        foreach ($downloads as $download) {
            $entityManager->remove($download);
            $deletedCount++;
        }

        $entityManager->flush();

        $this->addFlash('success', $deletedCount . " export(s) supprimé(s) de l'historique.");

        return $this->redirectToRoute('download_list');
    }

}
