<?php

namespace App\Controller\Back\User;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Form\Back\User\AddUserType;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Back\User\ModifyUserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class IndexController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    /**
    * @Route("/admin/utilisateurs", name="user_list")
    */
    public function index(UserRepository $userAdmin): Response
    {
        return $this->render('back/user/list.html.twig', [
            'user' => $userAdmin->findBy(array(), array('firstname' => 'ASC')),
        ]);
    }  

    /**
    * @Route("/admin/utilisateurs/{id}/supprimer", name="user_delete")
    * @param User $user
    * return RedirectResponse
    */
    public function deleteUser(User $user): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute("user_list");
    }
    
}
