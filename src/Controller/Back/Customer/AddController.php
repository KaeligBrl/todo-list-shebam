<?php

namespace App\Controller\Back\Customer;

use App\Entity\Customer;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Back\Customer\AddCustomerType;
use App\Service\NotificationContextService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager) {
    $this->entityManager = $entityManager;
    }
    public function index(Request $request, NotificationContextService $notificationContext): Response {
        $customerAdd = new Customer();
        $form = $this->createForm(AddCustomerType::class, $customerAdd);
        $notification = null;
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($customerAdd);
            $this->entityManager->flush();
            $notification = $notificationContext->format('Administration - Client', 'Le client a bien été ajouté');
            $customerAdd = new Customer();
            $form = $this->createForm(AddCustomerType::class, $customerAdd);
        }
            return $this->render('back/customer/add.html.twig', [
                'form_customer_add_back' => $form->createView(),
                'notification' => $notification
            ]);
        }
    
}
