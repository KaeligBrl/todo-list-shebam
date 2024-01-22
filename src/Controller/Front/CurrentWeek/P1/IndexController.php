<?php

namespace App\Controller\Front\CurrentWeek\P1;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AppointmentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Front\Task\AddTaskP1CurrentWeekType;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Form\Front\Task\ModifyTaskP1CurrentWeekType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/semaine-actuelle/p1", name="current_week_p1")
     */
    public function index(TaskRepository $taskList,AppointmentRepository $appointment, Request $request): Response
    {
    
        $taskAdd = new Task();
        $form_p1 = $this->createForm(AddTaskP1CurrentWeekType::class, $taskAdd);
        $notification = null;
        $form_p1->handleRequest($request);
        if ($form_p1->isSubmitted() && $form_p1->isValid()) {
            $this->entityManager->persist($taskAdd);
            $this->entityManager->flush();
            return $this->redirectToRoute("current_week_p1");
        }


        return $this->render('front/current_week/task/p1/list.html.twig', [
            'task' => $taskList->findBy([], ['position' => 'ASC']),
            'appointment' => $appointment,
            'form_task_cw_p1_add' => $form_p1->createView(),
            'notification' => $notification,
        ]);
    }

    /**
     * @Route("/semaine-actuelle/p1/supprimer/{id}", name="delete_task_cw_p1")
     * @param Task $taskDelete
     * return RedirectResponse
     */
    public function deleteTask(Task $taskDelete): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($taskDelete);
        $em->flush();

        return $this->redirectToRoute("current_week_p1");
    }


    /**
     * @Route("/semaine-actuelle/basculer/tache/p1-en-p2/{id}", name="change_task_cw_p1_to_p2")
     * return RedirectResponse
     */
    public function changeTaskToP2Front(Task $task, TaskRepository $taskRepository): Response
    {
        $taskRepository->setChangeTaskForP2CurrentWeek($task->getId());

        return $this->redirectToRoute("current_week_p1");
    }

    /**
     * @Route("/semaine-actuelle/basculer/tache/p1/semaine-suivante/{id}", name="change_task_p1_cw_to_p1_nw")
     * return RedirectResponse
     */
    public function changeTaskP1CurrentWeekToP1NextWeek(Task $task, TaskRepository $taskRepository): Response
    {
        $taskRepository->setChangeTaskP1CurrentWeekToP1NextWeek($task->getId());

        return $this->redirectToRoute("current_week_p1");
    }

    /**
     * @Route("/semaine-actuelle/fait/p1/{id}", name="done_task_cw_p1_checkbox")
     */
    public function taskDone(Task $taskdone)
    {
        $taskdone->setDone(($taskdone->getDone()) ? false : true);
        $em = $this->getDoctrine()->getManager();
        $em->persist($taskdone);
        $em->flush();

        return new Response("true");
    }

    /**
     * @Route("/reorder", name="reorder")
     */
    public function reorderTaskP1Row(Request $request, TaskRepository $taskRow, AppointmentRepository $appointmentRow)
    {
        $cpt = 0;
        switch ($request->request->get("context")) {
            case '1':
                foreach (json_decode($request->request->get("table"), true /* est-ce que je veux un tableau assoc oui (par défaut false) */) as $row) {
                    $task = $taskRow->find($row['id']); //on récupère la task
                    $task->setPosition($cpt); //on definit la position
                    $cpt++; //on ajoute une rangée
                }
            break;

            case '2':
                foreach (json_decode($request->request->get("table"), true) as $row) {
                    $appt = $appointmentRow->find($row['id']);
                    $appt->setPosition($cpt);
                    $cpt++;
                }
            break;
        }

        $this->entityManager->flush();
        return new JsonResponse([
            'data' => gettype($request->request->get("context"))
        ]);
    }
    /**
     * @Route("/update-task-status", name="update_task_status", methods={"POST"})
     */
    public function updateTaskStatus(Request $request)
    {
        // Récupérez les données de la requête
        $taskId = $request->request->get('taskId');
        $isChecked = $request->request->get('isChecked');

        // Mettez à jour le statut de la tâche dans votre système de stockage de données (par exemple, base de données)

        // Retournez une réponse JSON pour indiquer le succès de la mise à jour
        return new JsonResponse(['success' => true]);
    }
}
