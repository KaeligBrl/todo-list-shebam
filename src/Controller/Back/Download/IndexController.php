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
        $basePath = $this->getParameter('kernel.project_dir') . '/public/pdf/';
        $filesView = [];

        foreach ($files as $file) {
            $absolutePath = $basePath . $file->getName();
            $exists = is_file($absolutePath);

            $filesView[] = [
                'entity' => $file,
                'exists' => $exists,
                'size' => $exists ? filesize($absolutePath) : null,
            ];
        }

        return $this->render('back/current_week/file/list.html.twig', [
            'files_view' => $filesView,
        ]);
    }
}
