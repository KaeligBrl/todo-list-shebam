<?php

namespace App\Controller\Front\NextWeek\WaitingReturn;

use App\Entity\WaitingReturn;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AppointmentRepository;
use App\Repository\WaitingReturnRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Front\WaitingReturn\AddWaitingReturnNextWeekType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/semaine-suivante/attente-retour", name="next_week_waiting_return")
     */
    public function index(WaitingReturnRepository $waitingReturnList, Request $request): Response
    {

        $waitingReturnAdd = new WaitingReturn();
        $form_waiting_return = $this->createForm(AddWaitingReturnNextWeekType::class, $waitingReturnAdd);
        $notification = null;
        $form_waiting_return->handleRequest($request);
        
        if ($form_waiting_return->isSubmitted() && $form_waiting_return->isValid()) {
            $this->entityManager->persist($waitingReturnAdd);
            $this->entityManager->flush();
            return $this->redirectToRoute("next_week_waiting_return");
        }

        return $this->render('front/next_week/waiting_return/list.html.twig', [
            'waitingReturns' => $waitingReturnList->findBy([], ['position' => 'ASC']),
            'form_nw_waiting_return_add' => $form_waiting_return->createView(),
            'notification' => $notification,
        ]);
    }
}
