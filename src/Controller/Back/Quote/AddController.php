<?php

namespace App\Controller\Back\Quote;

use App\Entity\Quote;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Back\Quote\AddQuoteCurrentWeekType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/semaine-actuelle/devis/ajouter", name="add_quote_cw")
     */
    public function addTaskQuote(Request $request): Response
    {
        $quoteAdd = new Quote();
        $form = $this->createForm(AddQuoteCurrentWeekType::class, $quoteAdd);
        $notification = null;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($quoteAdd);
            $this->entityManager->flush();
            $notification = 'Le devis a bien été ajouté';
            $quoteAdd = new Quote();
            $form = $this->createForm(AddQuoteCurrentWeekType::class, $quoteAdd);
        }
        return $this->render('back/current_week/quote/add.html.twig', [
            'form_quote_cw_add' => $form->createView(),
            'notification' => $notification
        ]);
    }

}