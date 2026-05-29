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
    #[Route('/admin/telechargement/{id}/supprimer', name: 'delete_download', methods: ['POST'])]
    public function deleteStatus(File $downloadDelete, Request $request, EntityManagerInterface $entityManager): RedirectResponse
    {
        if (!$this->isCsrfTokenValid('delete_download_' . $downloadDelete->getId(), (string) $request->request->get('_token'))) {
            $this->addFlash('danger', 'Token CSRF invalide.');

            return $this->redirectToRoute('download_list');
        }

        $fileName = $this->getParameter('kernel.project_dir') . '/public/pdf/' . $downloadDelete->getName();
        if (file_exists($fileName)) {
            unlink($fileName);
        }

        $entityManager->remove($downloadDelete);
        $entityManager->flush();

        $this->addFlash('success', 'Telechargement supprime.');

        return $this->redirectToRoute("download_list");
    }
}
