<?php

namespace App\Command;

use App\Repository\FileRepository;
use App\Service\DownloadPdfGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

#[AsCommand(name: 'app:download:process', description: 'Traite un telechargement PDF en file asynchrone')]
class ProcessDownloadCommand extends Command
{
    public function __construct(
        private readonly FileRepository $fileRepository,
        private readonly EntityManagerInterface $entityManager,
        private readonly DownloadPdfGenerator $downloadPdfGenerator,
        private readonly LoggerInterface $logger,
        #[Autowire('%kernel.project_dir%')] private readonly string $projectDir,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('id', InputArgument::REQUIRED, 'ID du telechargement a traiter');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $id = (int) $input->getArgument('id');

        $file = $this->fileRepository->find($id);
        if ($file === null) {
            $io->error('Telechargement introuvable.');

            return Command::FAILURE;
        }

        $absolutePath = $this->projectDir . '/public/pdf/' . $file->getName();

        try {
            $file->setStatus('processing');
            $file->setErrorMessage(null);
            $this->entityManager->flush();

            $bytes = $this->downloadPdfGenerator->generateCurrentWeekPdf($absolutePath);

            $file->setStatus('done');
            $file->setSize($bytes);
            $file->setErrorMessage(null);
            $this->entityManager->flush();

            $io->success('Telechargement genere.');

            return Command::SUCCESS;
        } catch (\Throwable $e) {
            $file->setStatus('failed');
            $file->setErrorMessage($e->getMessage());
            $this->entityManager->flush();

            $this->logger->error('Echec generation asynchrone telechargement', [
                'exception' => $e,
                'file_id' => $file->getId(),
                'path' => $absolutePath,
            ]);

            $io->error('Echec de generation: ' . $e->getMessage());

            return Command::FAILURE;
        }
    }
}
