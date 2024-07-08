<?php

namespace App\Controller\Front\IdeaBam;

use App\Repository\IdeaBamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WaitingReturnIdeaBamChangeToWaitingReturnController extends AbstractController
{
    private $ideaBamRepository;

    public function __construct(IdeaBamRepository $ideaBamRepository)
    {
        $this->ideaBamRepository = $ideaBamRepository;
    }

    /**
     * @Route("/ideabam/changer-ideabam-attente-retour-vers-ideabam/{id}", name="ideabam_waiting_return_to_ideabam")
     */
    public function changeWaitingReturn($id): Response
    {
        $result = $this->ideaBamRepository->setChangeIdeabamWaitingReturnToIdeabam($id);

        return $this->redirectToRoute('ideabam_waiting_return');
    }
}
