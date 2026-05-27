<?php

namespace App\Controller\Front\Customer;

use App\Entity\Customer;
use App\Repository\CustomerRepository;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CreateController extends AbstractController
{
    #[Route('/api/front/customer/create', name: 'front_customer_create', methods: ['POST'])]
    public function __invoke(
        Request $request,
        CustomerRepository $customerRepository,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        $payload = json_decode($request->getContent(), true);
        $name = trim((string) (($payload['name'] ?? $request->request->get('name')) ?? ''));

        if ($name === '') {
            return new JsonResponse([
                'success' => false,
                'message' => 'Le nom du client est obligatoire.',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $existingCustomer = $customerRepository->findOneByNameInsensitive($name);
        if ($existingCustomer instanceof Customer) {
            return new JsonResponse([
                'success' => true,
                'created' => false,
                'id' => $existingCustomer->getId(),
                'name' => $existingCustomer->getName(),
            ]);
        }

        $customer = new Customer();
        $customer->setName($name);
        $customer->setArchived(false);

        try {
            $entityManager->persist($customer);
            $entityManager->flush();
        } catch (UniqueConstraintViolationException) {
            $existingCustomer = $customerRepository->findOneByNameInsensitive($name);
            if (!$existingCustomer instanceof Customer) {
                return new JsonResponse([
                    'success' => false,
                    'message' => 'Impossible de creer le client pour le moment.',
                ], Response::HTTP_CONFLICT);
            }

            return new JsonResponse([
                'success' => true,
                'created' => false,
                'id' => $existingCustomer->getId(),
                'name' => $existingCustomer->getName(),
            ]);
        }

        return new JsonResponse([
            'success' => true,
            'created' => true,
            'id' => $customer->getId(),
            'name' => $customer->getName(),
        ]);
    }
}
