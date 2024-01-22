<?php

namespace App\Controller\Back\Quote;

use App\Entity\Quote;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ToCurrentWeekController extends AbstractController
{
    /**
     * @Route("/basculer/quote/semaine-actuelle/id={id}", name="change_quote_nw_to_cw")
     * return RedirectResponse
     */
    public function changeQuoteNextToCurrentWeek(Quote $quoteChange): Response
    {
        $rep = $this->getDoctrine()
            ->getRepository(Quote::class)
            ->setChangeQuoteNextWeekToCurrentWeek($quoteChange->getId());

        return $this->redirectToRoute("next_week");
    }

}