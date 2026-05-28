<?php

namespace App\Controller\Front\NextWeek\P2;

use App\Entity\Task;
use App\Repository\CustomerRepository;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\Front\Task\AddTaskP2NextWeekType;
use App\Form\Front\Task\ModifyTaskP2NextWeekType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/semaine-suivante/p2', name: 'next_week_p2')]
    public function index(
        TaskRepository $taskList,
        Request $request,
        CustomerRepository $customerRepository,
        UserRepository $userRepository,
    ): Response
    {
        $taskp2Add = new Task();
        $form_p2 = $this->createForm(AddTaskP2NextWeekType::class, $taskp2Add);
        $notification = null;
        $form_p2->handleRequest($request);
        $showInlineAddForm = $form_p2->isSubmitted() && !$form_p2->isValid();
        
        if ($form_p2->isSubmitted() && $form_p2->isValid()) {
            $this->entityManager->persist($taskp2Add);
            $this->entityManager->flush();

            if ($request->isXmlHttpRequest()) {
                return new JsonResponse([
                    'success' => true,
                    'task' => [
                        'id' => $taskp2Add->getId(),
                        'customer' => (string) $taskp2Add->getCustomer(),
                        'subject' => (string) $taskp2Add->getObject(),
                        'deadline_display' => $taskp2Add->getDeadline()?->format('d/m/Y H:i'),
                        'note' => $taskp2Add->getNote(),
                        'users' => array_map(
                            static fn($user) => $user->getFirstname(),
                            $taskp2Add->getUsers()->toArray()
                        ),
                    ],
                ]);
            }

            return $this->redirectToRoute("next_week_p2");
        }

        if ($request->isXmlHttpRequest() && $form_p2->isSubmitted()) {
            $errors = [];
            foreach ($form_p2->getErrors(true) as $error) {
                $errors[] = $error->getMessage();
            }

            return new JsonResponse([
                'success' => false,
                'errors' => $errors,
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return $this->render('front/next_week/task/p2/list.html.twig', [
            'task' => $taskList->findBy([], ['position' => 'ASC']),
            'customers' => $customerRepository->findBy([], ['name' => 'ASC']),
            'usersList' => $userRepository->findBy([], ['firstname' => 'ASC']),
            'form_task_cw_p2_add' => $form_p2->createView(),
            'show_inline_add_form' => $showInlineAddForm,
            'notification' => $notification,
        ]);
    }

}
