<?php

namespace App\Controller\Back\Customer;

use App\Entity\Customer;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Back\Customer\AddCustomerType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Back\Customer\ModifyCustomerType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModifyController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/admin/client/{id}/modifier", name="modify_customer_back")
     */
    public function modifyTask(Request $request, Customer $customerModify): Response
    {
        $form = $this->createForm(ModifyCustomerType::class, $customerModify);
        $notification = null;
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $customerModify = $form->getData();
            $this->entityManager->persist($customerModify);
            $this->entityManager->flush();
            $notification = 'Client mise à jour !';
            $form = $this->createForm(ModifyCustomerType::class, $customerModify);
        }
        return $this->render('back/customer/modify.html.twig',[
            'form_customer_modify_admin' => $form->createView(),
            'notification' =>$notification,
            'customer' => $customerModify
        ]);   
    }
    
}
