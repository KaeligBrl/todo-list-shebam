<?php

namespace App\Controller\Back;

use App\Entity\File;
use App\Service\DownloadPdfGenerator;
use App\Service\RoleService;
use Psr\Log\LoggerInterface;
use App\Repository\FileRepository;
use App\Repository\UserRepository;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private $logger;
    public function __construct(EntityManagerInterface $entityManager, LoggerInterface $logger) {
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    #[Route('/admin', name: 'admin_dashboard')]
    public function dashboard(
        CustomerRepository $customerRepository,
        UserRepository $userRepository,
        FileRepository $fileRepository,
        RoleService $roleService
    ): Response
    {
        return $this->render('back/dashboard.html.twig', [
            'stats' => [
                'customers' => count($customerRepository->findAll()),
                'users' => count($userRepository->findAll()),
                'roles' => count($roleService->getRoles()),
                'downloads' => count($fileRepository->findAll()),
            ],
        ]);
    }


    // -------------------------------------------
    // ----------- Download All Missions ---------
    // -------------------------------------------

    #[Route('/generation-de-l-archive/', name: 'download', methods: ['POST'])]
    public function archivedBtn(Request $request, DownloadPdfGenerator $downloadPdfGenerator): Response
    {
        if (!$this->isCsrfTokenValid('generate_download', (string) $request->request->get('_token'))) {
            $this->addFlash('danger', 'Token CSRF invalide pour la generation du telechargement.');

            return $this->redirectToRoute('current_week_p1');
        }

        try {
            $pdfContent = $downloadPdfGenerator->renderCurrentWeekPdf();
        } catch (\Throwable $e) {
            $this->logger->error('Impossible de generer le PDF de telechargement en memoire', [
                'exception' => $e,
            ]);

            $this->addFlash('danger', 'Impossible de generer le PDF.');

            return $this->redirectToRoute('current_week_p1');
        }

        $dateFile = date('d-m-y-H-i');
        $fileName = 'liste-des-taches-du-' . $dateFile . '.pdf';

        $historyItem = new File();
        $historyItem->setName('Export PDF hebdomadaire');
        $historyItem->setStatus('done');
        $historyItem->setSize(strlen($pdfContent));
        $historyItem->setErrorMessage(null);
        $this->entityManager->persist($historyItem);
        $this->entityManager->flush();

        return new Response($pdfContent, Response::HTTP_OK, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $fileName . '"',
            'Content-Length' => (string) strlen($pdfContent),
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
        ]);
    }

}
