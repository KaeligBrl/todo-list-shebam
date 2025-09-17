<?php

namespace App\Controller\Back\User;

use App\Entity\User;
use App\Form\Back\User\AddUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AddController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager) {
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
    
}
