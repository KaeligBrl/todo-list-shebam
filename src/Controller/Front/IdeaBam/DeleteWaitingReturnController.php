<?php

namespace App\Controller\Front\IdeaBam;

use App\Entity\IdeaBam;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteWaitingReturnController extends AbstractController
{
    /**
     * @Route("/idebam/attente-retour/supprimer/{id}", name="delete_waiting_return_ideabam")
     */
    public function deleteIdeaBam(IdeaBam $taskIdeamBam, EntityManagerInterface $entityManager): RedirectResponse
    {
        $entityManager->remove($taskIdeamBam);
        $entityManager->flush();

        return $this->redirectToRoute("ideabam_waiting_return");
    }

}
