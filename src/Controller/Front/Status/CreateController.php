<?php

namespace App\Controller\Front\Status;

use App\Entity\Status;
use App\Repository\StatusRepository;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CreateController extends AbstractController
{
    #[Route('/api/front/status/create', name: 'front_status_create', methods: ['POST'])]
    public function __invoke(
        Request $request,
        StatusRepository $statusRepository,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        $payload = json_decode($request->getContent(), true);
        $name = trim((string) (($payload['name'] ?? $request->request->get('name')) ?? ''));

        if ($name === '') {
            return new JsonResponse([
                'success' => false,
                'message' => 'Le nom du statut est obligatoire.',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $existingStatus = $statusRepository->findOneByNameInsensitive($name);
        if ($existingStatus instanceof Status) {
            return new JsonResponse([
                'success' => true,
                'created' => false,
                'id' => $existingStatus->getId(),
                'name' => $existingStatus->getName(),
            ]);
        }

        $status = new Status();
        $status->setName($name);

        try {
            $entityManager->persist($status);
            $entityManager->flush();
        } catch (UniqueConstraintViolationException) {
            $existingStatus = $statusRepository->findOneByNameInsensitive($name);
            if (!$existingStatus instanceof Status) {
                return new JsonResponse([
                    'success' => false,
                    'message' => 'Impossible de creer le statut pour le moment.',
                ], Response::HTTP_CONFLICT);
            }

            return new JsonResponse([
                'success' => true,
                'created' => false,
                'id' => $existingStatus->getId(),
                'name' => $existingStatus->getName(),
            ]);
        }

        return new JsonResponse([
            'success' => true,
            'created' => true,
            'id' => $status->getId(),
            'name' => $status->getName(),
        ]);
    }
}
