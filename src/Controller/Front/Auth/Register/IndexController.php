<?php

namespace App\Controller\Front\Auth\Register;

use App\Entity\User;
use App\Form\Front\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\NotificationContextService;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class IndexController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    #[Route('/inscription', name: 'register')]
    public function index(Request $request, UserPasswordHasherInterface $passwordHasher, NotificationContextService $notificationContext): Response {

        if ($this->getUser() instanceof UserInterface === true) {
            return $this->redirectToRoute('current_week_p1');
        }

        $user = new User();

        $form = $this->createForm(RegisterType:: class, $user);
        $notification = null;

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $password = $passwordHasher->hashPassword($user, $user->getPassword());
            $user->setPassword($password);

            $this->entityManager->persist($user);
            $this->entityManager->flush();
            $notification = $notificationContext->format('Inscription', 'Tu es désormais inscris sur le site');
            return $this->redirectToRoute('register_message_success');

    }

        return $this->render('front/register/index.html.twig',[
            'user' => $user,
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }
    
}
