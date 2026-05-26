<?php

namespace App\Controller\Back\User;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    #[Route('/admin/utilisateurs', name: 'user_list')]
    public function index(UserRepository $userAdmin): Response
    {
        return $this->render('back/user/list.html.twig', [
            'user' => $userAdmin->findBy(array(), array('firstname' => 'ASC')),
        ]);
    }
    
}
