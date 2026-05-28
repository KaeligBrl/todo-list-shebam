<?php

namespace App\Controller\Front\NextWeek\Appointment;

use App\Entity\Appointment;
use App\Entity\User;
use App\Repository\UserRepository;
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

    #[Route('/semaine-suivante/rendez-vous/inline-update/{id}', name: 'next_week_appointment_inline_update', methods: ['POST'])]
    public function __invoke(
        Request $request,
        Appointment $appointment,
        UserRepository $userRepository,
    ): JsonResponse {
        $name = trim((string) ($request->request->get('name') ?? ''));
        $subject = trim((string) ($request->request->get('subject') ?? ''));
        $hoursRaw = trim((string) ($request->request->get('hoursappointment') ?? ''));
        $payload = $request->request->all();
        $rawUserIds = $payload['user_ids'] ?? [];
        $userIds = is_array($rawUserIds) ? $rawUserIds : [$rawUserIds];

        $errors = [];

        if ($name === '') {
            $errors[] = 'Le client est obligatoire.';
        }

        if ($subject === '') {
            $errors[] = 'Le sujet est obligatoire.';
        }

        $hoursappointment = null;
        if ($hoursRaw === '') {
            $errors[] = 'La date et heure est obligatoire.';
        } else {
            $hoursappointment = \DateTimeImmutable::createFromFormat('Y-m-d\\TH:i', $hoursRaw) ?: null;
            if (!$hoursappointment) {
                $errors[] = 'Format de date invalide.';
            }
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

        if ($errors !== []) {
            return new JsonResponse([
                'success' => false,
                'errors' => $errors,
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $appointment->setName($name);
        $appointment->setSubject($subject);
        $appointment->setHoursappointment($hoursappointment);
        $appointment->setNextweek(true);

        foreach ($appointment->getUser()->toArray() as $existingUser) {
            $appointment->removeUser($existingUser);
        }
        foreach ($selectedUsers as $selectedUser) {
            $appointment->addUser($selectedUser);
        }

        $this->entityManager->persist($appointment);
        $this->entityManager->flush();

        return new JsonResponse([
            'success' => true,
            'appointment' => [
                'id' => $appointment->getId(),
                'name' => $appointment->getName() ?? '',
                'subject' => $appointment->getSubject() ?? '',
                'hours_value' => $appointment->getHoursappointment()?->format('Y-m-d\\TH:i') ?? '',
                'hours_display' => $appointment->getHoursappointment()?->format('d-m-Y \\a H:i') ?? '',
                'users' => array_map(
                    static fn(User $user): array => [
                        'firstname' => $user->getFirstname() ?? '',
                        'profile_picture' => $user->getProfilePicture() ?? '',
                    ],
                    $appointment->getUser()->toArray()
                ),
                'user_ids' => array_map(
                    static fn(User $user): int => (int) $user->getId(),
                    $appointment->getUser()->toArray()
                ),
            ],
        ]);
    }
}
