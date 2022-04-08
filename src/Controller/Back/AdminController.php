<?php

namespace App\Controller\Back;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\File;
use Psr\Log\LoggerInterface;
use App\Repository\TaskRepository;
use App\Repository\QuoteRepository;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AppointmentRepository;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{

    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // -------------------------------------------
    // ----------- Download All Missions ---------
    // -------------------------------------------

    /**
     *@Route("/admin/liste-des-taches/generation-de-l-archive/", name="btn_task_archived_back")
     */
    public function archivedBtn(TaskRepository $task, AppointmentRepository $appointment, QuoteRepository $quote, LoggerInterface $logger, $length = 2, $characters = 'abcdefghijklmnopqrstuvwxyz0123456789'): RedirectResponse
    {

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Gotham');
        $pdfOptions->setIsRemoteEnabled(true);
        $dompdf = new Dompdf($pdfOptions);
        $dompdf->setPaper('A3', 'landscape');
        $html = $this->renderView('back/current_week/task/download.html.twig', [
            'task' => $task->findAll(),
            'appointment' => $appointment->findBy([], ['hoursappointment' => 'DESC']),
            'quote' => $quote->findAll(),
        ]);
        $dompdf->loadHtml($html);
        $dompdf->render();
        $output = $dompdf->output();

        $image = new File;
        $charactersLength = strlen($characters);
        $randomString = '';
        for (
            $i = 0;
            $i < $length;
            $i++
        ) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $path = $this->getParameter('download_task_directory');

        $dateFile = date("d-m-y");
        $fileName = 'liste-des-taches-du-' . $dateFile . '-' . $randomString . '.pdf';

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

        return $this->redirectToRoute("download_list_back");
    }


    /**
     * @Route("/admin/liste-des-taches/reorder", name="reorder_row_cw_back")
     */
    public function reorderRowCWback(Request $request, TaskRepository $taskRow, AppointmentRepository $appointmentRow, QuoteRepository $quoteRow)
    {
        $cpt = 0;
        switch ($request->request->get("context")) {
            case '1':
                foreach (json_decode($request->request->get("table"), true /* est-ce que je veux un tableau assoc oui (par défaut false) */) as $row) {
                    $task = $taskRow->find($row['id']); //on récupère la task
                    $task->setPosition($cpt); //on definit la position
                    $cpt++; //on ajoute une rangée
                }
                break;

            case '2':
                foreach (json_decode($request->request->get("table"), true) as $row) {
                    $appt = $appointmentRow->find($row['id']);
                    $appt->setPosition($cpt);
                    $cpt++;
                }
                break;

            case '3':
                foreach (json_decode($request->request->get("table"), true) as $row) {
                    $quote = $quoteRow->find($row['id']);
                    $quote->setPosition($cpt);
                    $cpt++;
                }
                break;
        }

        $this->entityManager->flush();
        return new JsonResponse([
            'data' => gettype($request->request->get("context"))
        ]);
    }

    /**
     * @Route("/admin/liste-des-taches/semaine-suivante/reorder", name="reorder_row_nw_back")
     */
    public function reorderRowNWback(Request $request, TaskRepository $taskRow, AppointmentRepository $appointmentRow, QuoteRepository $quoteRow)
    {
        $cpt = 0;
        switch ($request->request->get("context")) {
            case '1':
                foreach (json_decode($request->request->get("table"), true /* est-ce que je veux un tableau assoc oui (par défaut false) */) as $row) {
                    $task = $taskRow->find($row['id']); //on récupère la task
                    $task->setPosition($cpt); //on definit la position
                    $cpt++; //on ajoute une rangée
                }
                break;

            case '2':
                foreach (json_decode($request->request->get("table"), true) as $row) {
                    $appt = $appointmentRow->find($row['id']);
                    $appt->setPosition($cpt);
                    $cpt++;
                }
                break;

            case '3':
                foreach (json_decode($request->request->get("table"), true) as $row) {
                    $quote = $quoteRow->find($row['id']);
                    $quote->setPosition($cpt);
                    $cpt++;
                }
                break;
        }

        $this->entityManager->flush();
        return new JsonResponse([
            'data' => gettype($request->request->get("context"))
        ]);
    }

}
