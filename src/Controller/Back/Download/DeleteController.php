<?php

namespace App\Controller\Back\Download;

use App\Entity\File;
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

    public function deleteStatus(File $downloadDelete): RedirectResponse
    {
        $fileName = $this->getParameter('download_task_directory') . '/' . $downloadDelete->getName();
        if(file_exists($fileName)){
            unlink($fileName);
            }
        $em = $this->getDoctrine()->getManager();
        $em->remove($downloadDelete);
        $em->flush();
        return $this->redirectToRoute("download_list");
    }
}
