<?php

namespace App\Controller\Back\Download;

use App\Entity\File;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteController extends AbstractController
{
    /**
     * @Route("/admin/telechargement/{id}/supprimer", name="delete_download")
     * @param File $downloadDelete
     * return RedirectResponse
     */

    public function deleteStatus(File $downloadDelete, EntityManagerInterface $entityManager): RedirectResponse
    {
        $fileName = $this->getParameter('kernel.project_dir') . '/public/downloads/' . $downloadDelete->getName();
        if(file_exists($fileName)){
            unlink($fileName);
            }
        $entityManager->remove($downloadDelete);
        $entityManager->flush();
        return $this->redirectToRoute("download_list");
    }
}
