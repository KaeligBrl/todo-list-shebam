<?php

namespace App\Controller\Back\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteController extends AbstractController
{
    /**
    * @Route("/admin/utilisateurs/{id}/supprimer", name="user_delete")
    * @param User $user
    * @param EntityManagerInterface $entityManager
    * return RedirectResponse
    */
    public function deleteUser(User $user, EntityManagerInterface $entityManager): RedirectResponse
    {
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute("user_list");
    }
    
}
