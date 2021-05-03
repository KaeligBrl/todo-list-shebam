<?php

namespace App\Controller\Front;

use App\Entity\Tache;
use App\Repository\TacheRepository;
use App\Repository\RendezvousRepository;
use App\Repository\QuoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(TacheRepository $tacheAdmin, RendezvousRepository $rendezvousAdmin, QuoteRepository $quoteAdmin): Response
    {
        return $this->render('front/home/index.html.twig', [
            'tache' => $tacheAdmin->findAll(),
            'rendezvous' => $rendezvousAdmin->findAll(),
            'quote' => $quoteAdmin->findAll(),
        ]);
    }
}
