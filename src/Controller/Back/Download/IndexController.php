<?php

namespace App\Controller\Back\Download;

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
}
