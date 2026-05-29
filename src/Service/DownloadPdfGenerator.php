<?php

namespace App\Service;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Repository\TaskRepository;
use App\Repository\AppointmentRepository;

class DownloadPdfGenerator
{
    public function __construct(
        private readonly TaskRepository $taskRepository,
        private readonly AppointmentRepository $appointmentRepository,
        private readonly \Twig\Environment $twig,
    ) {
    }

    public function renderCurrentWeekPdf(): string
    {
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Gotham');
        $pdfOptions->setIsRemoteEnabled(true);

        $dompdf = new Dompdf($pdfOptions);
        $dompdf->setPaper('A3', 'landscape');

        $html = $this->twig->render('back/current_week/file/download.html.twig', [
            'task' => $this->taskRepository->findAll(),
            'appointment' => $this->appointmentRepository->findBy([], ['hoursappointment' => 'DESC']),
        ]);

        $dompdf->loadHtml($html);
        $dompdf->render();
        $output = $dompdf->output();

        if (trim($output) === '') {
            throw new \RuntimeException('Le PDF genere est vide.');
        }

        return $output;
    }
}
