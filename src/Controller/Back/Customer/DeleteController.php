<?php

namespace App\Controller\Back\Customer;

use App\Entity\Customer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager) {
    $this->entityManager = $entityManager;
    }

    #[Route('/admin/client/{id}/supprimer', name: 'delete_customer_back')]
    public function deleteStatut(Customer $customerDelete): RedirectResponse {
        $this->entityManager->remove($customerDelete);
        $this->entityManager->flush();
        return $this->redirectToRoute("list_customer");
    }
    
}
