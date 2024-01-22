<?php

namespace App\Controller\Back\Quote;

use App\Entity\Quote;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ToNextCurrentController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/basculer/devis/semaine-suivante/id={id}", name="change_quote_cw_to_nw")
     * return RedirectResponse
     */
    public function changeQuoteCurrentToNextWeek(Quote $quoteChange): Response
    {
        $rep = $this->getDoctrine()
            ->getRepository(Quote::class)
            ->setChangeQuoteCurrentWeekToNextWeek($quoteChange->getId());

        return $this->redirectToRoute("list_cw_mission_back");
    }

}