<?php

namespace App\Controller\Back;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\File;
use App\Service\RoleService;
use Psr\Log\LoggerInterface;
use App\Repository\FileRepository;
use App\Repository\UserRepository;
use App\Repository\TaskRepository;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AppointmentRepository;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
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
    public function archivedBtn(Request $request, TaskRepository $task, AppointmentRepository $appointment): RedirectResponse
    {
        if (!$this->isCsrfTokenValid('generate_download', (string) $request->request->get('_token'))) {
            $this->addFlash('danger', 'Token CSRF invalide pour la generation du telechargement.');

            return $this->redirectToRoute('current_week_p1');
        }


        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Gotham');
        $pdfOptions->setIsRemoteEnabled(true);
        $dompdf = new Dompdf($pdfOptions);
        $dompdf->setPaper('A3', 'landscape');
        $html = $this->renderView('back/current_week/file/download.html.twig', [
            'task' => $task->findAll(),
            'appointment' => $appointment->findBy([], ['hoursappointment' => 'DESC']),
        ]);

        try {
            $dompdf->loadHtml($html);
            $dompdf->render();
            $output = $dompdf->output();
        } catch (\Exception $e) {
            $this->logger->error('Erreur generation PDF des telechargements', [
                'exception' => $e,
            ]);
            $this->addFlash('danger', 'La generation du PDF a echoue.');

            return $this->redirectToRoute('download_list');
        }

        if (trim($output) === '') {
            $this->logger->error('Generation PDF vide pour les telechargements');
            $this->addFlash('danger', 'Le fichier PDF genere est vide.');

            return $this->redirectToRoute('download_list');
        }

        $image = new File;

        try {
            $randomString = bin2hex(random_bytes(6));
        } catch (\Exception $e) {
            $randomString = (string) random_int(100000, 999999);
        }

        $path = $this->getParameter('kernel.project_dir') . '/public/pdf/';

        $dateFile = date("d-m-y");
        $fileName = 'liste-des-taches-du-' . $dateFile . '-' . $randomString . '.pdf';

        $fsObject = new Filesystem();

        try {
            if (!$fsObject->exists($path)) {
                $fsObject->mkdir($path, 0755);
            }

            $file = $path . $fileName;
            $fsObject->dumpFile($file, $output);
            $fsObject->chmod($file, 0644);
        } catch (IOExceptionInterface $exception) {
            $this->logger->error('Erreur ecriture fichier PDF des telechargements', [
                'exception' => $exception,
                'path' => $path,
                'filename' => $fileName,
            ]);
            $this->addFlash('danger', 'Impossible d\'enregistrer le fichier PDF.');

            return $this->redirectToRoute('download_list');
        }

        $image->setName($fileName);
        $this->entityManager->persist($image);
        $this->entityManager->flush();

        $this->addFlash('success', 'Telechargement genere avec succes.');

        return $this->redirectToRoute("download_list");
    }

}
