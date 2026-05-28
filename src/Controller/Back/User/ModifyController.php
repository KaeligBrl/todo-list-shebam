<?php

namespace App\Controller\Back\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Back\User\ModifyUserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ModifyController extends AbstractController
{
    private $entityManager;
    private $parameterBag;
    private SluggerInterface $slugger;

    public function __construct(EntityManagerInterface $entityManager, ParameterBagInterface $parameterBag, SluggerInterface $slugger) {
        $this->entityManager = $entityManager;
        $this->parameterBag = $parameterBag;
        $this->slugger = $slugger;
    }

    #[Route('/admin/utilisateurs/{id}/modifier', name: 'user_modify')]
    public function modifyUser(User $userTitle, Request $request): Response
    {
        // Charger les rôles depuis le fichier YAML
        $rolesData = $this->getRolesData();
        $rolesChoices = $this->getRolesChoices($rolesData);

        $form = $this->createForm(ModifyUserType::class, $userTitle, [
            'roles_choices' => $rolesChoices // Passer les choix au formulaire
        ]);

        $notification = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            // Assurez-vous que les rôles sont stockés au format correct
            $roles = $form->get('roles')->getData(); // Récupère les rôles au format tableau
            $user->setRoles($roles); // La méthode setRoles doit accepter un tableau de chaînes

            $profilePictureFile = $form->get('profilePictureFile')->getData();
            if ($profilePictureFile instanceof UploadedFile) {
                $user->setProfilePicture($this->uploadProfilePicture($profilePictureFile, $user->getProfilePicture()));
            }

            $this->entityManager->persist($user);
            $this->entityManager->flush();
            $notification = 'Informations mises à jour !';
        }

        return $this->render('back/user/modify.html.twig', [
            'form_user_modify_admin' => $form->createView(),
            'notification' => $notification,
            'user' => $userTitle,
        ]);
    }

    private function getRolesData(): array
    {
        // Chemin vers le fichier roles.yaml
        $rolesFilePath = $this->parameterBag->get('kernel.project_dir') . '/config/roles.yaml';
        return Yaml::parseFile($rolesFilePath);
    }

    private function getRolesChoices(array $rolesData): array
    {
        $choices = [];
        foreach ($rolesData['roles'] as $roleKey => $roleConfig) {
            if (isset($roleConfig['label'])) {
                $choices[$roleConfig['label']] = $roleKey; // Utilise la clé comme valeur
            }
        }
        return $choices;
    }

    private function uploadProfilePicture(UploadedFile $file, ?string $existingPath): string
    {
        $uploadDir = $this->parameterBag->get('kernel.project_dir') . '/public/uploads/profile';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0775, true);
        }

        $originalName = (string) pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->sanitizeOriginalBaseName($originalName);

        $newFilename = $safeFilename . '.webp';
        $targetPath = $uploadDir . '/' . $newFilename;

        $mimeType = (string) ($file->getMimeType() ?: '');
        $sourcePath = $file->getPathname();

        $image = match ($mimeType) {
            'image/jpeg', 'image/jpg' => @imagecreatefromjpeg($sourcePath),
            'image/png' => @imagecreatefrompng($sourcePath),
            'image/gif' => @imagecreatefromgif($sourcePath),
            'image/webp' => @imagecreatefromwebp($sourcePath),
            default => null,
        };

        if (!$image) {
            throw new \RuntimeException('Impossible de lire l\'image source pour conversion WebP.');
        }

        imagepalettetotruecolor($image);
        imagealphablending($image, true);
        imagesavealpha($image, true);

        // Pas de redimensionnement: on conserve la resolution d'origine.
        $written = @imagewebp($image, $targetPath, 100);
        imagedestroy($image);

        if ($written !== true) {
            throw new \RuntimeException('Impossible d\'enregistrer l\'image en WebP.');
        }

        if ($existingPath) {
            $existingAbsolutePath = $this->parameterBag->get('kernel.project_dir') . '/public/' . ltrim($existingPath, '/');
            if (is_file($existingAbsolutePath) && realpath($existingAbsolutePath) !== realpath($targetPath)) {
                @unlink($existingAbsolutePath);
            }
        }

        return 'uploads/profile/' . $newFilename;
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
