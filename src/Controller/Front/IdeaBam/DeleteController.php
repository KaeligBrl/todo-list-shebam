<?php

namespace App\Controller\Front\IdeaBam;

use App\Entity\IdeaBam;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteController extends AbstractController
{
    /**
     * @Route("/idebam/supprimer/{id}", name="delete_ideabam")
     */
    public function deleteIdeaBam(IdeaBam $taskIdeamBam, EntityManagerInterface $entityManager): RedirectResponse
    {
        $entityManager->remove($taskIdeamBam);
        $entityManager->flush();

        return $this->redirectToRoute("ideabam");
    }


}
