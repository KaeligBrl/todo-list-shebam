<?php

namespace App\Controller\Back;

use Dompdf\Dompdf;
use Dompdf\Options;
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

    // ------------------------------
    // ------- Download Tasks -------
    // ------------------------------

    /**
     * @Route("/admin/telechargement/telecharger", name="button_list_download_admin")
     */
    public function taskDownload(TaskRepository $taskAdmin, AppointmentRepository $appointmentAdmin, QuoteRepository $quoteAdmin, Task2Repository $task2Admin)
    {
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Gotham');
        $pdfOptions->setIsRemoteEnabled(true);
        // la partie ssl de la vidéo a été supprimé 
        $dompdf = new Dompdf($pdfOptions);
        $html = $this->renderView('back/tasks_archived/download.html.twig', [
            'task' => $taskAdmin->findAll(),
            'appointment' => $appointmentAdmin->findAll(),
            'quote' => $quoteAdmin->findAll(),
            'task2' => $task2Admin->findAll(),
        ]);
        $dompdf->loadHtml($html);
        $dompdf->render();
        

        $pdfOutput = $dompdf->output();
        file_put_contents("liste-des-taches.pdf", $pdfOutput);

        return new Response('', 200, [
            'Content-Type' => 'application/pdf',
        ]);
    }
}
