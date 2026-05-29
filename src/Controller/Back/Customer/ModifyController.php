<?php

namespace App\Controller\Back\Customer;

use App\Entity\Customer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModifyController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/admin/client/{id}/modifier', name: 'modify_customer_back', methods: ['POST'])]
    public function modifyTask(Request $request, Customer $customerModify): JsonResponse
    {
        if (!$this->isCsrfTokenValid('modify_customer_back', (string) $request->request->get('_token'))) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Token CSRF invalide.',
            ], JsonResponse::HTTP_FORBIDDEN);
        }

        $name = trim((string) $request->request->get('name', ''));
        if ($name === '') {
            return new JsonResponse([
                'success' => false,
                'message' => 'Le nom du client est obligatoire.',
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $customerModify->setName($name);
        $this->entityManager->persist($customerModify);
        $this->entityManager->flush();

        return new JsonResponse([
            'success' => true,
            'customer' => [
                'id' => $customerModify->getId(),
                'name' => $customerModify->getName(),
            ],
        ]);
    }
}
