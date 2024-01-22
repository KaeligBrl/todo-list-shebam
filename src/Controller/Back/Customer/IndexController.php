<?php

namespace App\Controller\Back\Customer;

use App\Repository\CustomerRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    /**
     * @Route("/admin/client", name="list_customer")
     */
    public function listCustomers(CustomerRepository $customerRepository): Response
    {
        $totalCustomer = $customerRepository->getTotalCustomers();

        return $this->render('back/customer/list.html.twig', [
            'customers' => $customerRepository->findAllOrderedByName(),
            'totalCustomer' => $totalCustomer,
        ]);
    }
    
}
