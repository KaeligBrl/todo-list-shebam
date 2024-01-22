<?php

namespace App\Controller\Back\Download;

use App\Repository\FileRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    /**
     * @Route("admin/telechargements", name="download_list")
     */
    public function listDownload(FileRepository $downloadList): Response
    {
        return $this->render('back/current_week/file/list.html.twig', [
            'file' => $downloadList->findBy(array(), array('created_at' => 'desc')),
        ]);
    }
}
