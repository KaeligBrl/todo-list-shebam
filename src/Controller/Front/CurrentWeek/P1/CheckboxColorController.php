<?php

namespace App\Controller\Front\CurrentWeek\P1;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CheckboxColorController  extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/semaine-actuelle/handle-checkbox-change", name="current_week_checkbox_p1")
     */
    public function handleCheckboxChange(Request $request)
    {
        // Récupérez les données de la requête AJAX
        $taskId = $request->request->get('taskId');
        $isChecked = $request->request->get('isChecked');

        // Recherchez l'entité correspondante en utilisant $taskId
        $entityManager = $this->getDoctrine()->getManager();
        $entity = $entityManager->getRepository(Task::class)->find($taskId);

        if (!$entity) {
            // Gérez le cas où l'entité n'est pas trouvée
            return new JsonResponse(['success' => false, 'message' => 'Entity not found']);
        }

        // Mettez à jour la propriété 'color' de l'entité
        $entity->setColor($isChecked);

        // Enregistrez les modifications dans la base de données
        $entityManager->flush();

        // Réponse JSON pour confirmer le succès de l'opération
        return new JsonResponse(['success' => true]);
    }


}
