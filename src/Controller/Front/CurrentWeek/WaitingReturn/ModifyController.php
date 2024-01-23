<?php

namespace App\Controller\Front\CurrentWeek\WaitingReturn;

use App\Entity\WaitingReturn;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\Front\WaitingReturn\ModifyWaitingReturnCurrentWeekType;

class ModifyController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/semaine-actuelle/attente-retour/modifier/{id}", name="current_week_modify_waiting_return")
     */
    public function modifyWaitingReturnCurrentWeek(Request $request, WaitingReturn $waitingReturnModify): Response
    {
        $form = $this->createForm(ModifyWaitingReturnCurrentWeekType::class, $waitingReturnModify);
        $notification = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $waitingReturnModify = $form->getData();
            $this->entityManager->persist($waitingReturnModify);
            $this->entityManager->flush();
            $notification = 'L`attente de retour a été mise à jour !';
            $form = $this->createForm(ModifyWaitingReturnCurrentWeekType::class, $waitingReturnModify);
        }
        return $this->render('front/current_week/waiting_return/modify.html.twig', [
            'form_waiting_return_cw_modify' => $form->createView(),
            'notification' => $notification,
            'waitingReturns' => $waitingReturnModify
        ]);
    }
}
