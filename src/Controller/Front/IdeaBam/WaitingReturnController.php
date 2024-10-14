<?php

namespace App\Controller\Front\IdeaBam;

use App\Entity\IdeaBam;
use App\Repository\IdeaBamRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Front\IdeaBam\AddIdeaBamType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WaitingReturnController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/idebam/attente-retour", name="ideabam_waiting_return")
     */
    public function index(IdeaBamRepository $ideaBamList, Request $request): Response
    {
        return $this->render('front/ideabam/waiting_return.html.twig', [
            'ideas' => $ideaBamList->findIdeabamByWaitingReturnFalse(),
        ]);
    }


}
