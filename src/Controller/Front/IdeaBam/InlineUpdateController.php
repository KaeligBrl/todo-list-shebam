<?php

namespace App\Controller\Front\IdeaBam;

use App\Entity\IdeaBam;
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

    #[Route('/idebam/inline-update/{id}', name: 'ideabam_inline_update', methods: ['POST'])]
    public function __invoke(Request $request, IdeaBam $idea, UserRepository $userRepository): JsonResponse
    {
        $subject = trim((string) ($request->request->get('subject') ?? ''));
        $object = trim((string) ($request->request->get('object') ?? ''));

        $payload = $request->request->all();
        $rawPersonIds = $payload['person_ids'] ?? [];
        $personIds = is_array($rawPersonIds) ? $rawPersonIds : [$rawPersonIds];

        $errors = [];

        if ($subject === '') {
            $errors[] = 'Le sujet est obligatoire.';
        }

        $selectedUsers = [];
        foreach ($personIds as $personId) {
            if ($personId === null || $personId === '') {
                continue;
            }

            $user = $userRepository->find((int) $personId);
            if ($user instanceof User) {
                $selectedUsers[] = $user;
            }
        }

        if (count($selectedUsers) === 0) {
            $errors[] = 'Au moins une personne est requise.';
        }

        if ($errors !== []) {
            return new JsonResponse([
                'success' => false,
                'errors' => $errors,
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $idea->setSubject($subject);
        $idea->setObject($object !== '' ? $object : '');

        foreach ($idea->getPerson()->toArray() as $existingPerson) {
            $idea->removePerson($existingPerson);
        }

        foreach ($selectedUsers as $selectedUser) {
            $idea->addPerson($selectedUser);
        }

        $this->entityManager->persist($idea);
        $this->entityManager->flush();

        return new JsonResponse([
            'success' => true,
            'idea' => [
                'id' => $idea->getId(),
                'subject' => $idea->getSubject() ?? '',
                'object' => $idea->getObject() ?? '',
                'person' => array_map(
                    static fn(User $user): array => [
                        'id' => (int) $user->getId(),
                        'firstname' => $user->getFirstname() ?? '',
                        'profile_picture' => $user->getProfilePicture() ?? '',
                    ],
                    $idea->getPerson()->toArray()
                ),
                'person_ids' => array_map(
                    static fn(User $user): int => (int) $user->getId(),
                    $idea->getPerson()->toArray()
                ),
            ],
        ]);
    }
}
