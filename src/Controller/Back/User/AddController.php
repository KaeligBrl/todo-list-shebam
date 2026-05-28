<?php

namespace App\Controller\Back\User;

use App\Entity\User;
use App\Form\Back\User\AddUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class AddController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, private readonly SluggerInterface $slugger) {
        $this->entityManager = $entityManager;
    }

    #[Route('/admin/utilisateurs/ajouter', name: 'user_add')]
    public function addUser(Request $request, UserPasswordHasherInterface $hasher) {
        $user = new User();
        $form = $this->createForm(AddUserType:: class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
                $user = $form->getData();
                $password = $hasher->hashPassword($user,$user->getPassword());
                $user->setPassword($password);
                $profilePictureFile = $form->get('profilePictureFile')->getData();
                if ($profilePictureFile instanceof UploadedFile) {
                    $user->setProfilePicture($this->uploadProfilePicture($profilePictureFile));
                }
                $this->entityManager->persist($user);
                $this->entityManager->flush();
                $user = new User();
                $form = $this->createForm(AddUserType:: class, $user);
                return $this->redirectToRoute("user_list");
            }
        return $this->render('back/user/add.html.twig', [
            'form_admin_user_add' => $form->createView(),

        ]);
    }

    private function uploadProfilePicture(UploadedFile $file): string
    {
        $uploadDir = $this->getParameter('kernel.project_dir') . '/public/uploads/profile';
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
