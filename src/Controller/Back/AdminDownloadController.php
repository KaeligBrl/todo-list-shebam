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
        return $this->render('back/file/index.html.twig', [
            'file' =>$downloadAdmin->findBy(array(), array('name' => 'ASC')),
        ]);
    }

    /**
     * @Route("/admin/telechargement/{id}/supprimer", name="download_detete_admin")
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
        return $this->redirectToRoute("download_list_admin");
    }

    // ------------------------------
    // ------- Download Tasks -------
    // ------------------------------

    /**
     * @Route("/admin/telechargement/telecharger", name="button_list_download_admin")
     */
    
    public function taskDownload(TaskRepository $taskAdmin, AppointmentRepository $appointmentAdmin, QuoteRepository $quoteAdmin, Task2Repository $task2Admin, LoggerInterface $logger, $length = 2, $characters = 'abcdefghijklmnopqrstuvwxyz0123456789')
    {
        // # We define the date in Europe configuration
        // date_default_timezone_set('UTC');

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Gotham');
        $pdfOptions->setIsRemoteEnabled(true);
        $dompdf = new Dompdf($pdfOptions);
        $dompdf->setPaper('A3', 'landscape');
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
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length;
            $i++
        ) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $path = $this->getParameter('download_task_directory');
        
        $dateFile = date("d-m-y");
        $fileName = 'liste-des-taches-du-'. $dateFile .'-'. $randomString .'.pdf';
    
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
            $logger->error("Impossible de créer le fichier");
        }

        $image->setName($fileName);
        $this->entityManager->persist($image);
        $this->entityManager->flush();
        return $this->redirectToRoute('download_list_admin');
    }
}
