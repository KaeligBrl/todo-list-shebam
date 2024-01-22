<?php

namespace App\Controller\Back\User;

use App\Entity\User;

use Doctrine\ORM\EntityManagerInterface;
use App\Form\Back\User\ModifyUserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ModifyController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/admin/utilisateurs/{id}/modifier", name="user_modify")
     */
    public function modifyUser(User $userTitle, Request $request, User $user, UserPasswordEncoderInterface $encoder): Response
    {
        $form = $this->createForm(ModifyUserType::class, $user);
        $notification = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            $notification = 'Informations mises à jour !';
            $user = new User();
            $user = $form->getData();
            $form = $this->createForm(ModifyUserType::class, $user);
        }

        return $this->render('back/user/modify.html.twig', [
            'form_user_modify_admin' => $form->createView(),
            'notification' => $notification,
            'user' => $userTitle
        ]);
    }
    
}
