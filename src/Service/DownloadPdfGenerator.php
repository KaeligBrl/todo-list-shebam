<?php

namespace App\Service;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Repository\TaskRepository;
use App\Repository\AppointmentRepository;
use Symfony\Component\Filesystem\Filesystem;

class DownloadPdfGenerator
{
    public function __construct(
        private readonly TaskRepository $taskRepository,
        private readonly AppointmentRepository $appointmentRepository,
        private readonly \Twig\Environment $twig,
    ) {
    }

    public function generateCurrentWeekPdf(string $absoluteTargetPath): int
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

        $filesystem = new Filesystem();
        $directory = \dirname($absoluteTargetPath);

        if (!$filesystem->exists($directory)) {
            $filesystem->mkdir($directory, 0755);
        }

        $filesystem->dumpFile($absoluteTargetPath, $output);
        $filesystem->chmod($absoluteTargetPath, 0644);

        return \strlen($output);
    }
}
