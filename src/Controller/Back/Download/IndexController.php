<?php

namespace App\Controller\Back\Download;

use Psr\Log\LoggerInterface;
use App\Repository\FileRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\DownloadPdfGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    public function __construct(
        private readonly DownloadPdfGenerator $downloadPdfGenerator,
        private readonly EntityManagerInterface $entityManager,
        private readonly LoggerInterface $logger,
    ) {
    }

    #[Route('admin/telechargements', name: 'download_list')]
    public function listDownload(FileRepository $downloadList): Response
    {
        $processingItem = $downloadList->findOneBy(['status' => 'processing']);
        if ($processingItem === null) {
            $queuedItem = $downloadList->findOneBy(['status' => 'queued'], ['created_at' => 'ASC']);

            if ($queuedItem !== null) {
                $absolutePath = $this->getParameter('kernel.project_dir') . '/public/pdf/' . $queuedItem->getName();

                try {
                    $queuedItem->setStatus('processing');
                    $queuedItem->setErrorMessage(null);
                    $this->entityManager->flush();

                    $bytes = $this->downloadPdfGenerator->generateCurrentWeekPdf($absolutePath);

                    $queuedItem->setStatus('done');
                    $queuedItem->setSize($bytes);
                    $queuedItem->setErrorMessage(null);
                    $this->entityManager->flush();
                } catch (\Throwable $e) {
                    $queuedItem->setStatus('failed');
                    $queuedItem->setErrorMessage($e->getMessage());
                    $this->entityManager->flush();

                    $this->logger->error('Echec fallback de traitement telechargement dans la liste admin', [
                        'exception' => $e,
                        'file_id' => $queuedItem->getId(),
                    ]);
                }
            }
        }

        $files = $downloadList->findBy(array(), array('created_at' => 'desc'));
        $basePath = $this->getParameter('kernel.project_dir') . '/public/pdf/';
        $filesView = [];

        foreach ($files as $file) {
            $absolutePath = $basePath . $file->getName();
            $exists = is_file($absolutePath);
            $status = $file->getStatus();

            $filesView[] = [
                'entity' => $file,
                'exists' => $exists,
                'size' => $file->getSize() ?? ($exists ? filesize($absolutePath) : null),
                'status' => $status,
                'error' => $file->getErrorMessage(),
            ];
        }

        return $this->render('back/current_week/file/list.html.twig', [
            'files_view' => $filesView,
        ]);
    }
}
