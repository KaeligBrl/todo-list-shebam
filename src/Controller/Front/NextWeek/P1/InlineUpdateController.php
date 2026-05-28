<?php

namespace App\Controller\Front\NextWeek\P1;

use App\Entity\Task;
use App\Entity\User;
use App\Repository\CustomerRepository;
use App\Repository\StatusRepository;
use App\Repository\UserRepository;
use App\Service\TaskLiveVersionService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InlineUpdateController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    #[Route('/semaine-suivante/p1/inline-update/{id}', name: 'next_week_p1_inline_update', methods: ['POST'])]
    public function __invoke(
        Request $request,
        Task $task,
        CustomerRepository $customerRepository,
        StatusRepository $statusRepository,
        UserRepository $userRepository,
        TaskLiveVersionService $taskLiveVersionService,
    ): JsonResponse {
        $customerId = (int) ($request->request->get('customer_id') ?? 0);
        $statusId = (int) ($request->request->get('status_id') ?? 0);
        $object = trim((string) ($request->request->get('object') ?? ''));
        $note = trim((string) ($request->request->get('note') ?? ''));
        $deadlineRaw = trim((string) ($request->request->get('deadline') ?? ''));
        $payload = $request->request->all();
        $rawUserIds = $payload['user_ids'] ?? [];
        $userIds = is_array($rawUserIds) ? $rawUserIds : [$rawUserIds];
        $subobject1 = trim((string) ($request->request->get('subobject1') ?? ''));
        $subobject2 = trim((string) ($request->request->get('subobject2') ?? ''));
        $subobject3 = trim((string) ($request->request->get('subobject3') ?? ''));

        $errors = [];

        $customer = $customerId > 0 ? $customerRepository->find($customerId) : null;
        $status = $statusId > 0 ? $statusRepository->find($statusId) : null;
        if (!$customer) {
            $errors[] = 'Le client est obligatoire.';
        }

        if ($object === '') {
            $errors[] = 'Le sujet est obligatoire.';
        }

        $selectedUsers = [];
        if (count($userIds) === 0) {
            $errors[] = 'Au moins un membre de l\'equipe est requis.';
        } else {
            foreach ($userIds as $userId) {
                if ($userId === null || $userId === '') {
                    continue;
                }

                $user = $userRepository->find((int) $userId);
                if ($user) {
                    $selectedUsers[] = $user;
                }
            }

            if (count($selectedUsers) === 0) {
                $errors[] = 'Au moins un membre de l\'equipe est requis.';
            }
        }

        $deadline = null;
        if ($deadlineRaw !== '') {
            $deadline = \DateTimeImmutable::createFromFormat('Y-m-d\\TH:i', $deadlineRaw) ?: null;
            if (!$deadline) {
                $errors[] = 'Format de deadline invalide.';
            }
        }

        if ($errors !== []) {
            return new JsonResponse([
                'success' => false,
                'errors' => $errors,
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $task->setCustomer($customer);
        $task->setStatus($status);
        $task->setObject($object);
        $task->setSubObject1($subobject1 !== '' ? $subobject1 : null);
        $task->setSubObject2($subobject2 !== '' ? $subobject2 : null);
        $task->setSubObject3($subobject3 !== '' ? $subobject3 : null);
        $task->setNote($note !== '' ? $note : null);
        $task->setDeadline($deadline);
        $task->setP1(true);
        $task->setP2(false);
        $task->setNextweek(true);

        foreach ($task->getUsers()->toArray() as $existingUser) {
            $task->removeUser($existingUser);
        }
        foreach ($selectedUsers as $selectedUser) {
            $task->addUser($selectedUser);
        }

        $this->entityManager->persist($task);
        $this->entityManager->flush();

        $actor = $this->getUser();
        $taskLiveVersionService->recordChange('updated', $task, $actor instanceof User ? $actor : null);

        return new JsonResponse([
            'success' => true,
            'task' => [
                'id' => $task->getId(),
                'customer' => (string) $task->getCustomer(),
                'customer_id' => $task->getCustomer()?->getId(),
                'status' => (string) ($task->getStatus()?->getName() ?? ''),
                'status_id' => $task->getStatus()?->getId(),
                'subject' => (string) $task->getObject(),
                'subobject1' => $task->getSubObject1() ?? '',
                'subobject2' => $task->getSubObject2() ?? '',
                'subobject3' => $task->getSubObject3() ?? '',
                'deadline_value' => $task->getDeadline()?->format('Y-m-d\\TH:i') ?? '',
                'deadline_display' => $task->getDeadline()?->format('d/m/Y H:i') ?? '',
                'note' => $task->getNote() ?? '',
                'users' => array_map(
                    static fn(User $user): array => [
                        'firstname' => $user->getFirstname() ?? '',
                        'profile_picture' => $user->getProfilePicture() ?? '',
                    ],
                    $task->getUsers()->toArray()
                ),
                'user_ids' => array_map(
                    static fn(User $user): int => (int) $user->getId(),
                    $task->getUsers()->toArray()
                ),
            ],
        ]);
    }
}
