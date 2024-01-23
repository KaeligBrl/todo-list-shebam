<?php

namespace App\Controller\Front\NextWeek\WaitingReturn;

use App\Entity\WaitingReturn;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Front\WaitingReturn\ModifyWaitingReturnNextWeekType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModifyController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/semaine-suivante/attente-retour/modifier/{id}", name="next_week_modify_waiting_return")
     */
    public function modifyWaitingReturnNextWeek(Request $request, WaitingReturn $waitingReturnModify): Response
    {
        $form = $this->createForm(ModifyWaitingReturnNextWeekType::class, $waitingReturnModify);
        $notification = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $waitingReturnModify = $form->getData();
            $this->entityManager->persist($waitingReturnModify);
            $this->entityManager->flush();
            $notification = 'L`attente de retour a été mise à jour !';
            $form = $this->createForm(ModifyWaitingReturnNextWeekType::class, $waitingReturnModify);
        }
        return $this->render('front/next_week/waiting_return/modify.html.twig', [
            'form_waiting_return_nw_modify' => $form->createView(),
            'notification' => $notification,
            'waitingReturns' => $waitingReturnModify
        ]);
    }
}
