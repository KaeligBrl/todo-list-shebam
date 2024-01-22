<?php

namespace App\Controller\Back\Quote;

use App\Entity\Quote;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Front\Quote\ModifyQuoteNextWeekType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModifyNextWeekController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/semaine-suivante/devis/modifier/id={id}", name="modify_quote_nw")
     */
    public function modifyQuoteNextWeek(Request $request, Quote $quoteModify): Response
    {
        $form = $this->createForm(ModifyQuoteNextWeekType::class, $quoteModify);
        $notification = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $quoteModify = $form->getData();
            $this->entityManager->persist($quoteModify);
            $this->entityManager->flush();
            $notification = 'Le devis a bien été mis à jour !';
            $form = $this->createForm(ModifyQuoteNextWeekType::class, $quoteModify);
        }
        return $this->render('front/next_week/quote/modify.html.twig', [
            'form_quote_nw_modify' => $form->createView(),
            'notification' => $notification,
            'quote' => $quoteModify
        ]);
    }

}