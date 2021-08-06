<?php

namespace App\Controller\Back;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\File;
use Psr\Log\LoggerInterface;
use App\Repository\FileRepository;
use App\Repository\TaskRepository;
use App\Repository\QuoteRepository;
use App\Repository\Task2Repository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AppointmentRepository;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminDownloadController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("admin/telechargement", name="download_list_admin")
     */
    public function listDownload(FileRepository $downloadAdmin): Response
    {
        return $this->render('back/download/index.html.twig', [
            'download' =>$downloadAdmin->findBy(array(), array('name' => 'ASC')),
        ]);
    }

    /**
     * @Route("/admin/telechargement/{id}/supprimer", name="download_detete_admin")
     * @param File $downloadDelete
     * return RedirectResponse
     */
    public function deleteStatus(File $downloadDelete): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($downloadDelete);
        $em->flush();
        return $this->redirectToRoute("download_list_admin");
    }

    // ------------------------------
    // ------- Download Tasks -------
    // ------------------------------

    /**
     * @Route("/admin/telechargement/telecharger", name="button_list_download_admin")
     */
    public function taskDownload(TaskRepository $taskAdmin, AppointmentRepository $appointmentAdmin, QuoteRepository $quoteAdmin, Task2Repository $task2Admin, LoggerInterface $logger)
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
        $output = $dompdf->output();

        $image = new File;
        $path = $this->getParameter('download_task_directory');
        $fileName = md5(uniqid()) . '.pdf';
        $fsObject = new Filesystem();

        try {
            if (!$fsObject->exists($path)) {
                $fsObject->mkdir($path);
            }
            $file = $path . $fileName;
            if (!$fsObject->exists($file)) {
                $fsObject->touch($file);
                $fsObject->chmod($file, 0777);
                $fsObject->dumpFile($file, $output);
            }


        } catch (IOExceptionInterface $exception) {
            $this->$logger->error("Impossible de créer le fichier");
        }

        $image->setName($fileName);
        $this->entityManager->persist($image);
        $this->entityManager->flush();

        return new Response('', Response::HTTP_OK, [
            'Content-Type' => 'application/pdf',
        ]);
    }
}
