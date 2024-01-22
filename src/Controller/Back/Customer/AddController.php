<?php

namespace App\Controller\Back\Customer;

use App\Entity\Customer;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Back\Customer\AddCustomerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
    $this->entityManager = $entityManager;
    }
    /**
     * @Route("/admin/client/ajouter", name="add_customer_back")
     */
    public function index(Request $request): Response {
        $customerAdd = new Customer();
        $form = $this->createForm(AddCustomerType::class, $customerAdd);
        $notification = null;
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($customerAdd);
            $this->entityManager->flush();
            $notification = 'Le client a bien été ajouté';
            $customerAdd = new Customer();
            $form = $this->createForm(AddCustomerType::class, $customerAdd);
        }
            return $this->render('back/customer/add.html.twig', [
                'form_customer_add_back' => $form->createView(),
                'notification' => $notification
            ]);
        }
    
}
