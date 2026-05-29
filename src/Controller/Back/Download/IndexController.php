<?php

namespace App\Controller\Back\Download;

use App\Entity\File;
use App\Service\DownloadPdfGenerator;
use App\Repository\FileRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    #[Route('admin/telechargements', name: 'download_list')]
    public function listDownload(FileRepository $downloadList): Response
    {
        $files = $downloadList->findBy(array(), array('created_at' => 'desc'));
        $filesView = [];

        foreach ($files as $file) {
            $status = $file->getStatus();
            $label = $file->getName();

            if (is_string($label) && str_ends_with($label, '.pdf')) {
                $label = 'Export PDF hebdomadaire';
            }

            $filesView[] = [
                'entity' => $file,
                'label' => $label ?: 'Export PDF hebdomadaire',
                'size' => $file->getSize(),
                'status' => $status,
                'error' => $file->getErrorMessage(),
            ];
        }

        return $this->render('back/current_week/file/list.html.twig', [
            'files_view' => $filesView,
        ]);
    }

    #[Route('/admin/telechargement/{id}/voir', name: 'view_download', methods: ['GET'])]
    public function viewDownload(File $download, DownloadPdfGenerator $downloadPdfGenerator): Response
    {
        $pdfContent = $downloadPdfGenerator->renderCurrentWeekPdf();
        $fileName = 'export-' . $download->getId() . '-' . $download->getCreatedAt()?->format('d-m-y-H-i') . '.pdf';

        return new Response($pdfContent, Response::HTTP_OK, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $fileName . '"',
            'Content-Length' => (string) strlen($pdfContent),
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
        ]);
    }
}
