<?php

namespace App\Controller\Back;

use App\Entity\File;
use App\Service\RoleService;
use Psr\Log\LoggerInterface;
use App\Repository\FileRepository;
use App\Repository\UserRepository;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Process\Process;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    private $entityManager;
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
    public function archivedBtn(Request $request): RedirectResponse
    {
        if (!$this->isCsrfTokenValid('generate_download', (string) $request->request->get('_token'))) {
            $this->addFlash('danger', 'Token CSRF invalide pour la generation du telechargement.');

            return $this->redirectToRoute('current_week_p1');
        }

        $image = new File;

        try {
            $randomString = bin2hex(random_bytes(6));
        } catch (\Exception $e) {
            $randomString = (string) random_int(100000, 999999);
        }

        $dateFile = date("d-m-y");
        $fileName = 'liste-des-taches-du-' . $dateFile . '-' . $randomString . '.pdf';

        $image->setName($fileName);
        $image->setStatus('queued');
        $image->setSize(null);
        $image->setErrorMessage(null);
        $this->entityManager->persist($image);
        $this->entityManager->flush();

        $consolePath = $this->getParameter('kernel.project_dir') . '/bin/console';
        $environment = (string) $this->getParameter('kernel.environment');
        $preferredPhpBinary = 'C:/wamp64/bin/php/php8.4.15/php.exe';
        $phpBinary = is_file($preferredPhpBinary) ? $preferredPhpBinary : PHP_BINARY;

        try {
            $process = new Process([
                $phpBinary,
                $consolePath,
                'app:download:process',
                (string) $image->getId(),
                '--env=' . $environment,
                '--no-interaction',
            ]);

            $process->setTimeout(null);
            $process->disableOutput();
            $process->start();
        } catch (\Throwable $e) {
            $image->setStatus('failed');
            $image->setErrorMessage('Echec du lancement du traitement: ' . $e->getMessage());
            $this->entityManager->flush();

            $this->logger->error('Impossible de lancer le traitement asynchrone du telechargement', [
                'exception' => $e,
                'file_id' => $image->getId(),
            ]);

            $this->addFlash('danger', 'Impossible de lancer la generation asynchrone.');

            return $this->redirectToRoute('download_list');
        }

        $this->addFlash('success', 'Generation lancee. Le statut se mettra a jour automatiquement.');

        return $this->redirectToRoute("download_list");
    }

}
