<?php

namespace App\Controller\Back;

use App\Entity\Download;
use App\Repository\TaskRepository;
use App\Repository\QuoteRepository;
use App\Repository\Task2Repository;
use App\Repository\DownloadRepository;
use App\Repository\AppointmentRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminDownloadController extends AbstractController
{

    /**
     * @Route("admin/telechargement", name="download_list_admin")
     */
    public function listDownload(DownloadRepository $downloadAdmin): Response
    {
        return $this->render('back/download/index.html.twig', [
            'download' =>$downloadAdmin->findBy(array(), array('name' => 'ASC')),
        ]);
    }

    /**
     * @Route("/admin/telechargement/{id}/supprimer", name="download_detete_admin")
     * @param Download $downloadDelete
     * return RedirectResponse
     */
    public function deleteStatus(Download $statutDelete): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($statutDelete);
        $em->flush();
        return $this->redirectToRoute("download_list_admin");
    }
}
