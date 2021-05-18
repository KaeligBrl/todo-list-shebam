<?php

namespace App\Controller\Back;

use App\Entity\Task2;
use App\Repository\Task2Repository;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Back\Task2\AdminTask2AddType;
use App\Form\Back\Task2\AdminTask2ModifyType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminTask2Controller extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
    $this->entityManager = $entityManager;
    }

    /**
     * @Route("/admin/liste-des-taches-p2/ajouter", name="task2_list_add_admin")
     */
    public function index(Request $request): Response {
        $task2Add = new Task2();
        $form = $this->createForm(AdminTask2AddType::class, $task2Add);
        $notification = null;
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($task2Add);
            $this->entityManager->flush();
            $notification = 'La tâche P2 a bien été ajoutée';
            $task2Add = new Task2();
            $form = $this->createForm(AdminTask2AddType::class, $task2Add);
        }
            return $this->render('back/task2/add.html.twig', [
                'form_task_p2_add_admin' => $form->createView(),
                'notification' => $notification
            ]);
        }

    /**
     * @Route("/admin/liste-des-taches-p2/{id}/supprimer", name="task2_list_detete_admin")
     * @param Task2 $task2
     * return RedirectResponse
     */
    public function deleteTask2(Task2 $task2): RedirectResponse {
        $em = $this->getDoctrine()->getManager();
        $em->remove($task2);
        $em->flush();
        return $this->redirectToRoute("task_list_admin");
    }

    /**
     * @Route("/admin/liste-des-taches-p2/{id}/modifier", name="task2_list_modify_admin")
     */
    public function modifyTask2(Request $request, Task2 $task2Modify): Response
    {
        $form = $this->createForm(AdminTask2ModifyType::class, $task2Modify);
        $notification = null;
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $task2Modify = $form->getData();
            $this->entityManager->persist($task2Modify);
            $this->entityManager->flush();
            $notification = 'Tâche P2 a bien été mise à jour !';
            $form = $this->createForm(AdminTask2ModifyType::class, $task2Modify);
        }
        return $this->render('back/task2/modify.html.twig',[
            'form_task_p2_modify_admin' => $form->createView(),
            'notification' => $notification
        ]);   
    }
}