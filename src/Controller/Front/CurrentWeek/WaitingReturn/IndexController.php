<?php

namespace App\Controller\Front\CurrentWeek\WaitingReturn;

use App\Entity\WaitingReturn;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AppointmentRepository;
use App\Repository\WaitingReturnRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Front\WaitingReturn\AddWaitingReturnCurrentWeekType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/semaine-actuelle/attente-retour", name="current_week_waiting_return")
     */
    public function index(WaitingReturnRepository $waitingReturnList, Request $request): Response
    {

        $waitingReturnAdd = new WaitingReturn();
        $form_waiting_return = $this->createForm(AddWaitingReturnCurrentWeekType::class, $waitingReturnAdd);
        $notification = null;
        $form_waiting_return->handleRequest($request);
        if ($form_waiting_return->isSubmitted() && $form_waiting_return->isValid()) {
            $this->entityManager->persist($waitingReturnAdd);
            $this->entityManager->flush();
            return $this->redirectToRoute("current_week_waiting_return");
        }

        return $this->render('front/current_week/waiting_return/list.html.twig', [
            'waitingReturns' => $waitingReturnList->findBy([], ['position' => 'ASC']),
            'form_cw_waiting_return_add' => $form_waiting_return->createView(),
            'notification' => $notification,
        ]);
    }
}
