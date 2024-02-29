<?php

namespace App\Controller\Front\CurrentWeek\WaitingReturn;

use App\Entity\WaitingReturn;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AppointmentRepository;
use App\Repository\WaitingReturnRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReorderController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/reorder-waiting-return-current-week", name="reorder-waiting-return-current-week")
     */
    public function reorderWaitingReturnCurrentWeek(Request $request, WaitingReturnRepository $waitingReturnRow)
    {
        $cpt = 0;
        switch ($request->request->get("context")) {
            case '1':
                foreach (json_decode($request->request->get("table"), true /* est-ce que je veux un tableau assoc oui (par défaut false) */) as $row) {
                    $waitingReturn = $waitingReturnRow->find($row['id']); //on récupère la task
                    $waitingReturn->setPosition($cpt); //on definit la position
                    $cpt++; //on ajoute une rangée
                }
            break;
        }

        $this->entityManager->flush();
        return new JsonResponse([
            'data' => gettype($request->request->get("context"))
        ]);
    }
}
