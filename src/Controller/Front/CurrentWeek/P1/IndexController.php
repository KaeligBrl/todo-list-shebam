<?php

namespace App\Controller\Front\CurrentWeek\P1;

use App\Entity\User;
use App\Entity\Task;
use App\Repository\CustomerRepository;
use App\Repository\StatusRepository;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AppointmentRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\Front\Task\AddTaskP1CurrentWeekType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    #[Route('/semaine-actuelle/p1', name: 'current_week_p1')]
    public function index(
        TaskRepository $taskList,
        AppointmentRepository $appointment,
        CustomerRepository $customerRepository,
        UserRepository $userRepository,
        StatusRepository $statusRepository,
        Request $request
    ): Response
    {
        $taskAdd = new Task();
        $form_p1 = $this->createForm(AddTaskP1CurrentWeekType::class, $taskAdd);
        $notification = null;
        $form_p1->handleRequest($request);
        $showInlineAddForm = $form_p1->isSubmitted() && !$form_p1->isValid();

        if ($form_p1->isSubmitted() && $form_p1->isValid()) {
            $this->entityManager->persist($taskAdd);
            $this->entityManager->flush();

            if ($request->isXmlHttpRequest()) {
                return new JsonResponse([
                    'success' => true,
                    'task' => [
                        'id' => $taskAdd->getId(),
                        'customer' => (string) $taskAdd->getCustomer(),
                        'customer_id' => $taskAdd->getCustomer()?->getId(),
                        'subject' => (string) $taskAdd->getObject(),
                        'subobject1' => $taskAdd->getSubObject1() ?? '',
                        'subobject2' => $taskAdd->getSubObject2() ?? '',
                        'subobject3' => $taskAdd->getSubObject3() ?? '',
                        'status' => (string) ($taskAdd->getStatus()?->getName() ?? ''),
                        'status_id' => $taskAdd->getStatus()?->getId(),
                        'deadline_value' => $taskAdd->getDeadline()?->format('Y-m-d\\TH:i') ?? '',
                        'deadline_display' => $taskAdd->getDeadline()?->format('d/m/Y H:i'),
                        'note' => $taskAdd->getNote(),
                            'users' => array_map(
                                static fn(User $user): array => [
                                    'firstname' => $user->getFirstname() ?? '',
                                    'profile_picture' => $user->getProfilePicture() ?? '',
                                ],
                                $taskAdd->getUsers()->toArray()
                            ),
                        'user_ids' => array_map(
                            static fn($user) => (int) $user->getId(),
                            $taskAdd->getUsers()->toArray()
                        ),
                    ],
                ]);
            }

            return $this->redirectToRoute("current_week_p1");
        }

        if ($request->isXmlHttpRequest() && $form_p1->isSubmitted()) {
            $errors = [];
            foreach ($form_p1->getErrors(true) as $error) {
                $errors[] = $error->getMessage();
            }

            return new JsonResponse([
                'success' => false,
                'errors' => $errors,
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return $this->render('front/current_week/task/p1/list.html.twig', [
            'task' => $taskList->findAllOrderByUsers(),
            'appointment' => $appointment,
            'customers' => $customerRepository->findBy([], ['name' => 'ASC']),
            'usersList' => $userRepository->findBy([], ['firstname' => 'ASC']),
            'statusesList' => $statusRepository->findBy([], ['name' => 'ASC']),
            'form_task_cw_p1_add' => $form_p1->createView(),
            'show_inline_add_form' => $showInlineAddForm,
            'notification' => $notification,
        ]);
    }


}
