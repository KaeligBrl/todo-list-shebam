<?php

namespace App\Controller\Back\Customer;

use App\Entity\Customer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteController extends AbstractController
{
    #[Route('/admin/clients/supprimer-selection', name: 'delete_customer_batch', methods: ['POST'])]
    public function deleteBatch(Request $request, EntityManagerInterface $entityManager): RedirectResponse
    {
        if (!$this->isCsrfTokenValid('delete_customer_batch', (string) $request->request->get('_token'))) {
            $this->addFlash('danger', 'Token CSRF invalide.');

            return $this->redirectToRoute('list_customer');
        }

        $rawIds = $request->request->all('customer_ids');
        if (!is_array($rawIds)) {
            $rawIds = [];
        }

        $ids = array_values(array_unique(array_filter(array_map('intval', $rawIds), static fn (int $id): bool => $id > 0)));
        if ($ids === []) {
            $this->addFlash('warning', 'Aucun client selectionne.');

            return $this->redirectToRoute('list_customer');
        }

        $customers = $entityManager->getRepository(Customer::class)->findBy(['id' => $ids]);
        $deletedCount = 0;

        foreach ($customers as $customer) {
            $entityManager->remove($customer);
            $deletedCount++;
        }

        $entityManager->flush();

        $this->addFlash('success', $deletedCount . " client(s) supprimé(s) de l'historique.");

        return $this->redirectToRoute('list_customer');
    }
}
