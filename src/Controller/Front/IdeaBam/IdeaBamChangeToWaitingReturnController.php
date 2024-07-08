<?php

namespace App\Controller\Front\IdeaBam;

use App\Repository\IdeaBamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IdeaBamChangeToWaitingReturnController extends AbstractController
{
    private $ideaBamRepository;

    public function __construct(IdeaBamRepository $ideaBamRepository)
    {
        $this->ideaBamRepository = $ideaBamRepository;
    }

    /**
     * @Route("/ideabam/changer-vers-attente-retour/{id}", name="ideabam_to_waiting_return")
     */
    public function changeWaitingReturn($id): Response
    {
        $result = $this->ideaBamRepository->setChangeIdeabamIdeabamWaitingReturn($id);

        return $this->redirectToRoute('ideabam');
    }
}
