<?php

namespace App\Controller\Front;

use App\Entity\Task;
use App\Repository\QuoteRepository;
use App\Repository\TaskRepository;
use App\Repository\Task2Repository;
use App\Repository\RendezvousRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(TaskRepository $taskAdmin, RendezvousRepository $rendezvousAdmin, QuoteRepository $quoteAdmin, Task2Repository $task2Admin): Response
    {
        return $this->render('front/home/index.html.twig', [
            'task' => $taskAdmin->findAll(),
            'rendezvous' => $rendezvousAdmin->findAll(),
            'quote' => $quoteAdmin->findAll(),
            'task2' => $task2Admin->findAll(),
        ]);
    }
}
