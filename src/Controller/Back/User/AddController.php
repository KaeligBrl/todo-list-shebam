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

        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = (string) $this->slugger->slug($originalName);
        $extension = $file->guessExtension() ?: 'bin';
        $newFilename = $safeFilename . '-' . uniqid('', true) . '.' . $extension;

        $file->move($uploadDir, $newFilename);

        return 'uploads/profile/' . $newFilename;
    }
    
}
