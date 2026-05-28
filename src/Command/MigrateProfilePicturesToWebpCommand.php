<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

#[AsCommand(
    name: 'app:images:migrate-profile-webp',
    description: 'Convertit les photos de profil existantes en WebP et met a jour les chemins en base.'
)]
class MigrateProfilePicturesToWebpCommand extends Command
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly EntityManagerInterface $entityManager,
        private readonly ParameterBagInterface $parameterBag,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addOption('dry-run', null, InputOption::VALUE_NONE, 'Affiche les operations sans ecrire les fichiers ni la base.')
            ->addOption('keep-original', null, InputOption::VALUE_NONE, 'Conserve les fichiers originaux apres conversion.')
            ->addOption('force', null, InputOption::VALUE_NONE, 'Ecrase un fichier .webp cible deja existant.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $dryRun = (bool) $input->getOption('dry-run');
        $keepOriginal = (bool) $input->getOption('keep-original');
        $force = (bool) $input->getOption('force');

        if (!\function_exists('imagewebp')) {
            $io->error('La fonction GD imagewebp() est indisponible sur cet environnement.');

            return Command::FAILURE;
        }

        $projectDir = rtrim((string) $this->parameterBag->get('kernel.project_dir'), DIRECTORY_SEPARATOR);
        $users = $this->userRepository->findAll();

        $converted = 0;
        $updated = 0;
        $skipped = 0;
        $failed = 0;

        foreach ($users as $user) {
            if (!$user instanceof User) {
                continue;
            }

            $currentPath = (string) ($user->getProfilePicture() ?? '');
            if ($currentPath === '') {
                $skipped++;
                continue;
            }

            $normalizedCurrentPath = ltrim(str_replace('\\', '/', $currentPath), '/');
            $absoluteCurrentPath = $projectDir . '/public/' . $normalizedCurrentPath;

            if (!is_file($absoluteCurrentPath)) {
                $io->warning(sprintf('Fichier introuvable pour user #%d: %s', (int) $user->getId(), $currentPath));
                $failed++;
                continue;
            }

            $dirPart = str_replace('\\', '/', (string) pathinfo($normalizedCurrentPath, PATHINFO_DIRNAME));
            if ($dirPart === '.' || $dirPart === '') {
                $dirPart = 'uploads/profile';
            }

            $baseName = (string) pathinfo($normalizedCurrentPath, PATHINFO_FILENAME);
            $safeBaseName = $this->sanitizeOriginalBaseName($baseName);
            if ($safeBaseName === 'image') {
                $safeBaseName = $this->sanitizeOriginalBaseName(
                    trim((string) ($user->getFirstname() ?? '')) . '-' . trim((string) ($user->getLastname() ?? ''))
                );
                if ($safeBaseName === 'image') {
                    $safeBaseName = 'user-' . (string) ($user->getId() ?? 'x');
                }
            }

            $newRelativePath = trim($dirPart, '/') . '/' . $safeBaseName . '.webp';
            $absoluteNewPath = $projectDir . '/public/' . $newRelativePath;

            $isCurrentWebp = str_ends_with(strtolower($normalizedCurrentPath), '.webp');
            if ($isCurrentWebp) {
                if ($normalizedCurrentPath === $newRelativePath) {
                    $skipped++;
                    continue;
                }

                if (is_file($absoluteNewPath) && !$force) {
                    $io->note(sprintf('Cible deja presente (utilise --force pour ecraser): %s', $newRelativePath));
                    $skipped++;
                    continue;
                }

                if (!$dryRun) {
                    if (is_file($absoluteNewPath) && $force) {
                        @unlink($absoluteNewPath);
                    }

                    $renamed = @rename($absoluteCurrentPath, $absoluteNewPath);
                    if ($renamed !== true) {
                        $io->warning(sprintf('Echec renommage WebP pour user #%d: %s -> %s', (int) $user->getId(), $currentPath, $newRelativePath));
                        $failed++;
                        continue;
                    }

                    $user->setProfilePicture($newRelativePath);
                    $updated++;
                }

                $converted++;
                $io->text(sprintf('OK user #%d: %s -> %s', (int) $user->getId(), $currentPath, $newRelativePath));
                continue;
            }

            if (is_file($absoluteNewPath) && !$force) {
                $io->note(sprintf('Cible deja presente (utilise --force pour ecraser): %s', $newRelativePath));

                if (!$dryRun) {
                    $user->setProfilePicture($newRelativePath);
                    $updated++;
                }

                $skipped++;
                continue;
            }

            $image = $this->createImageResource($absoluteCurrentPath);
            if (!$image) {
                $io->warning(sprintf('Format non supporte pour user #%d: %s', (int) $user->getId(), $currentPath));
                $failed++;
                continue;
            }

            imagepalettetotruecolor($image);
            imagealphablending($image, true);
            imagesavealpha($image, true);

            if (!$dryRun) {
                $ok = @imagewebp($image, $absoluteNewPath, 100);
                if ($ok !== true) {
                    imagedestroy($image);
                    $io->warning(sprintf('Echec ecriture WebP pour user #%d: %s', (int) $user->getId(), $newRelativePath));
                    $failed++;
                    continue;
                }

                $user->setProfilePicture($newRelativePath);
                $updated++;

                if (!$keepOriginal && realpath($absoluteCurrentPath) !== realpath($absoluteNewPath)) {
                    @unlink($absoluteCurrentPath);
                }
            }

            imagedestroy($image);
            $converted++;
            $io->text(sprintf('OK user #%d: %s -> %s', (int) $user->getId(), $currentPath, $newRelativePath));
        }

        if (!$dryRun && $updated > 0) {
            $this->entityManager->flush();
        }

        $io->success(sprintf(
            'Termine. converted=%d, updated=%d, skipped=%d, failed=%d, dry-run=%s',
            $converted,
            $updated,
            $skipped,
            $failed,
            $dryRun ? 'yes' : 'no'
        ));

        return $failed > 0 ? Command::FAILURE : Command::SUCCESS;
    }

    private function createImageResource(string $absolutePath)
    {
        $type = @exif_imagetype($absolutePath);
        if ($type === false) {
            return null;
        }

        return match ($type) {
            IMAGETYPE_JPEG => @imagecreatefromjpeg($absolutePath),
            IMAGETYPE_PNG => @imagecreatefrompng($absolutePath),
            IMAGETYPE_GIF => @imagecreatefromgif($absolutePath),
            IMAGETYPE_WEBP => @imagecreatefromwebp($absolutePath),
            default => null,
        };
    }

    private function sanitizeOriginalBaseName(string $baseName): string
    {
        $name = trim($baseName);
        $name = str_replace(["\\", "/"], '-', $name);
        $name = preg_replace('/[<>:"|?*\x00-\x1F]/u', '', $name) ?? '';
        $name = preg_replace('/([._-])[0-9a-f]{8,}(?:\.[0-9a-f]{6,}|\.[0-9]{6,})?$/i', '', $name) ?? $name;
        $name = preg_replace('/([._-])\d{10,}$/', '', $name) ?? $name;
        $name = rtrim($name, ". ");

        if ($name !== '' && ctype_digit($name)) {
            $name = 'image';
        }

        return $name !== '' ? $name : 'image';
    }
}
