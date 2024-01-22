<?php

namespace App\Controller\Back\Customer;

use App\Entity\Customer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
    $this->entityManager = $entityManager;
    }

    /**
     * @Route("/admin/client/{id}/supprimer", name="delete_customer_back")
     * @param Customer $customerDelete
     * return RedirectResponse
     */
    public function deleteStatut(Customer $customerDelete): RedirectResponse {
        $em = $this->getDoctrine()->getManager();
        $em->remove($customerDelete);
        $em->flush();
        return $this->redirectToRoute("list_customer");
    }
    
}
