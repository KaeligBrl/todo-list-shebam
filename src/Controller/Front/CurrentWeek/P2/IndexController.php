<?php

namespace App\Controller\Front\CurrentWeek\P2;

use App\Entity\User;
use App\Entity\Task;
use App\Repository\StatusRepository;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\Front\Task\AddTaskP2CurrentWeekType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    #[Route('/semaine-actuelle/p2', name: 'current_week_p2')]
    public function index(TaskRepository $taskList, StatusRepository $statusRepository, Request $request): Response
    {

        $taskp2Add = new Task();
        $form_p2 = $this->createForm(AddTaskP2CurrentWeekType::class, $taskp2Add);
        $notification = null;
        $form_p2->handleRequest($request);
        $showInlineAddForm = $form_p2->isSubmitted() && !$form_p2->isValid();
        if ($form_p2->isSubmitted() && $form_p2->isValid()) {
            $taskp2Add->setP2(true);
            $taskp2Add->setNextweek(false);
            $this->entityManager->persist($taskp2Add);
            $this->entityManager->flush();

            if ($request->isXmlHttpRequest()) {
                return new JsonResponse([
                    'success' => true,
                    'task' => [
                        'id' => $taskp2Add->getId(),
                        'customer' => (string) $taskp2Add->getCustomer(),
                        'customer_id' => $taskp2Add->getCustomer()?->getId(),
                        'subject' => (string) $taskp2Add->getObject(),
                        'subobject1' => $taskp2Add->getSubObject1() ?? '',
                        'subobject2' => $taskp2Add->getSubObject2() ?? '',
                        'subobject3' => $taskp2Add->getSubObject3() ?? '',
                        'status' => (string) ($taskp2Add->getStatus()?->getName() ?? ''),
                        'status_id' => $taskp2Add->getStatus()?->getId(),
                        'deadline_value' => $taskp2Add->getDeadline()?->format('Y-m-d\\TH:i') ?? '',
                        'deadline_display' => $taskp2Add->getDeadline()?->format('d/m/Y H:i'),
                        'note' => $taskp2Add->getNote(),
                        'users' => array_map(
                            static fn(User $user): array => [
                                'firstname' => $user->getFirstname() ?? '',
                                'profile_picture' => $user->getProfilePicture() ?? '',
                            ],
                            $taskp2Add->getUsers()->toArray()
                        ),
                        'user_ids' => array_map(
                            static fn($user) => (int) $user->getId(),
                            $taskp2Add->getUsers()->toArray()
                        ),
                    ],
                ]);
            }

            return $this->redirectToRoute("current_week_p2");   
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

        return $this->render('front/current_week/task/p2/list.html.twig', [
            'task' => $taskList->findAllOrderByUsers(),
            'statusesList' => $statusRepository->findBy([], ['name' => 'ASC']),
            'form_task_cw_p2_add' => $form_p2->createView(),
            'show_inline_add_form' => $showInlineAddForm,
            'notification' => $notification,
        ]);
    }
}
