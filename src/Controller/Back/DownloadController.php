<?php

namespace App\Controller\Back;

use App\Entity\File;
use App\Repository\FileRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DownloadController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("admin/telechargements", name="download_list")
     */
    public function listDownload(FileRepository $downloadList): Response
    {
        return $this->render('back/current_week/file/list.html.twig', [
            'file' => $downloadList->findBy(array(), array('created_at' => 'desc')),
        ]);
    }

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
