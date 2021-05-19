<?php

namespace App\Controller\Back;

use App\Entity\User;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use App\Repository\QuoteRepository;
use App\Repository\Task2Repository;
use App\Repository\StatusRepository;
use App\Repository\CustomerRepository;
use App\Repository\RendezvousRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(UserRepository $userAdmin, TaskRepository $countTaskP1Board, Task2Repository $countTaskP2Board, RendezvousRepository $countAppointment, QuoteRepository $countQuote, StatusRepository $countStatus, UserRepository $countUser, CustomerRepository $countCustomer): Response
    {
        //Count Task P1
        $taskP1 = $countTaskP1Board->findAll();
        $countTaskP1Board = count($taskP1);

        //Count Task P2
        $taskP2 = $countTaskP2Board->findAll();
        $countTaskP2Board = count($taskP2);

        //Count Appointment
        $appointment = $countAppointment->findAll();
        $countAppointment = count($appointment);

        //Count Quote
        $quote = $countQuote->findAll();
        $countQuote = count($quote);

        //Count Statut
        $status = $countStatus->findAll();
        $countStatus = count($status);

        //Count User
        $user = $countUser->findAll();
        $countUser = count($user);

        //Count Customer
        $customer = $countCustomer->findAll();
        $countCustomer = count($customer);

        return $this->render('back/index.html.twig', [
            'countTaskP1Board' => $countTaskP1Board, 
            'countTaskP2Board'=> $countTaskP2Board,
            'countAppointment' => $countAppointment,            
            'countQuote' => $countQuote,
            'countStatus' => $countStatus,
            'countUser' => $countUser,
            'countCustomer' => $countCustomer

        ]);
    }
}
