<?php

namespace App\Controller\Back;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\Task;
use App\Entity\Quote;
use App\Entity\Task2;
use App\Entity\Statut;
use App\Entity\Appointment;
use App\Repository\TaskRepository;
use App\Repository\QuoteRepository;
use App\Repository\Task2Repository;
use App\Form\Back\Task\AdminTaskAddType;
use App\Repository\AppointmentRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Back\Task2\AdminTask2AddType;
use App\Form\Back\Task\AdminTaskModifyType;
use App\Form\Back\Task2\AdminTask2ModifyType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Back\Quote\AdminTaskQuoteAddType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Back\Quote\AdminTaskQuoteModifyType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Form\Back\Appointment\AdminTaskAppointmentAddType;
use App\Form\Back\Appointment\AdminTaskAppointmentModifyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminTasksController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
    $this->entityManager = $entityManager;
    }
    /**
     * @Route("/admin/liste-des-taches/", name="task_list_admin")
     */
    public function listTask(TaskRepository $taskAdmin, AppointmentRepository $rendezvousAdmin, QuoteRepository $quoteAdmin, Task2Repository $task2Admin): Response
    {

        return $this->render('back/task/list.html.twig', [
            'task' => $taskAdmin->findAll(),
            'appointment' => $rendezvousAdmin->findAll(),
            'quote' => $quoteAdmin->findAll(),
            'task2' => $task2Admin->findAll(),
        ]);
    }

    /**
     * @Route("/admin/liste-des-taches/archives", name="task_list_archived_admin")
     */
    public function listTaskArchived(TaskRepository $taskArchivedAdmin, AppointmentRepository $appointmentArchivedAdmin, QuoteRepository $quoteArchivedAdmin, Task2Repository $task2ArchivedAdmin): Response
    {
        return $this->render('back/task/archived.html.twig', [
            'task' => $taskArchivedAdmin->findAll(),
            'appointment' => $appointmentArchivedAdmin->findAll(),
            'quote' => $quoteArchivedAdmin->findAll(),
            'task2' => $task2ArchivedAdmin->findAll()
        ]);
    }

    // ------------------------------
    // --------- Priority 1 ---------
    // ------------------------------

    /**
     * @Route("/admin/liste-des-taches-p1/ajouter", name="task_list_add_admin")
     */
    public function taskP1(Request $request): Response {
        $taskAdd = new Task();
        $form = $this->createForm(AdminTaskAddType::class, $taskAdd);
        $notification = null;
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($taskAdd);
            $this->entityManager->flush();
            $notification = 'La tâche a bien été ajoutée';
            $taskAdd = new Task();
            $form = $this->createForm(AdminTaskAddType::class, $taskAdd);
        }
            return $this->render('back/task/add.html.twig', [
                'form_task_p1_add_admin' => $form->createView(),
                'notification' => $notification
            ]);
    }

    /**
     * @Route("/admin/liste-des-taches/{id}/modifier", name="task_list_modify_admin")
     */
    public function modifyTask(Request $request, Task $taskModify): Response
    {
        $form = $this->createForm(AdminTaskModifyType::class, $taskModify);
        $notification = null;
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $taskModify = $form->getData();
            $this->entityManager->persist($taskModify);
            $this->entityManager->flush();
            $notification = 'Tâche P1 mise à jour !';
            $form = $this->createForm(AdminTaskModifyType::class, $taskModify);
        }
        return $this->render('back/task/modify.html.twig',[
            'form_task_p1_modify_admin' => $form->createView(),
            'notification' => $notification
        ]);   
    }
    
    /**
     * @Route("/admin/liste-des-taches-p1/{id}/supprimer", name="task_list_detete_admin")
     * @param Task $task
     * return RedirectResponse
     */
    public function deleteTask(Task $task): RedirectResponse {
        $em = $this->getDoctrine()->getManager();
        $em->remove($task);
        $em->flush();

        return $this->redirectToRoute("task_list_admin");
    }

    /**
    * @Route("/admin/liste-des-taches-p1/{id}/archiver", name="taskp1_archived_admin")
    * return RedirectResponse
    */
    public function archivedTaskP1(Task $task): Response {

        $rep = $this->getDoctrine()
        ->getRepository(Task::class)
        ->setTaskForArchived($task->getId());
    
        return $this->redirectToRoute("task_list_admin"); 
    }

    /**
    * @Route("/admin/liste-des-taches-p1/{id}/desarchiver", name="taskp1_unarchived_admin")
    * return RedirectResponse
    */
    public function unarchivedTaskP1(Task $task): Response {

        $rep = $this->getDoctrine()
        ->getRepository(Task::class)
        ->setTaskForUnArchived($task->getId());
    
        return $this->redirectToRoute("task_list_archived_admin"); 
    }

    // ------------------------------
    // --------- Priority 2 ---------
    // ------------------------------

    /**
     * @Route("/admin/liste-des-taches-p2/ajouter", name="task2_list_add_admin")
     */
    public function taskP2(Request $request): Response {
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
            return $this->render('back/task/task2/add.html.twig', [
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

    /**
    * @Route("/admin/liste-des-taches-p2/{id}/archiver", name="task2_archived_admin")
    * return RedirectResponse
    */
    public function archivedTask2(Task2 $task2): Response {

        $rep = $this->getDoctrine()
        ->getRepository(Task2::class)
        ->setTask2ForArchived($task2->getId());
    
        return $this->redirectToRoute("task_list_admin"); 
    }

    /**
    * @Route("/admin/liste-des-taches-p2/{id}/desarchiver", name="task2_unarchived_admin")
    * return RedirectResponse
    */
    public function unarchivedTask2(Task2 $task2): Response {

        $rep = $this->getDoctrine()
        ->getRepository(Task2::class)
        ->setTask2ForUnarchived($task2->getId());
    
        return $this->redirectToRoute("task_list_archived_admin"); 
    }


    // ------------------------------
    // -------- Appointment ---------
    // ------------------------------

    /**
    * @Route("/admin/liste-des-taches/rendez-vous/ajouter", name="task_appointment_add_admin")
    */
    public function addTaskAppointment(Request $request): Response {
        $appointmentAdd = new Appointment();
        $form = $this->createForm(AdminTaskAppointmentAddType::class, $appointmentAdd);
        $notification = null;
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($appointmentAdd);
            $this->entityManager->flush();
            $notification = 'Le rendez-vous a bien été ajoutée';
            $appointmentAdd = new Appointment();
            $form = $this->createForm(AdminTaskAppointmentAddType::class, $appointmentAdd);
        }
            return $this->render('back/task/appointment/add.html.twig', [
                'form_appointment_add_admin' => $form->createView(),
                'notification' => $notification
            ]);
        }

    /**
     * @Route("/admin/liste-des-taches/rendez-vous/{id}/modifier", name="task_appointment_modify_admin")
     */
    public function modifyAppointment(Request $request, Appointment $appointmentModify): Response
    {
        $form = $this->createForm(AdminTaskAppointmentModifyType::class, $appointmentModify);
        $notification = null;
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $appointmentModify = $form->getData();
            $this->entityManager->persist($appointmentModify);
            $this->entityManager->flush();
            $notification = 'Le rendez-vous a bien été mise à jour !';
            $form = $this->createForm(AdminTaskAppointmentModifyType::class, $appointmentModify);
        }
        return $this->render('back/task/appointment/modify.html.twig',[
            'form_appointment_modify_admin' => $form->createView(),
            'notification' => $notification
        ]);   
    }

    /**
     * @Route("/admin/liste-des-taches/rendez-vous/{id}/supprimer", name="task_appointment_detete_admin")
     * @param Appointment $rendezvousDelete
     * return RedirectResponse
     */
    public function deleteQuote(Appointment $appointmentDelete): RedirectResponse {
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($appointmentDelete);
        $em->flush();

        return $this->redirectToRoute("task_list_admin");
        ;   
    }

    /**
    * @Route("/admin/liste-des-taches/rendez-vous/{id}/archiver", name="appointment_archived_admin")
    * return RedirectResponse
    */
    public function unarchivedAppointment(Appointment $appointment): Response {

        $rep = $this->getDoctrine()
        ->getRepository(Appointment::class)
        ->setAppointmentForArchived($appointment->getId());
    
        return $this->redirectToRoute("task_list_admin"); 
    }

    /**
    * @Route("/admin/liste-des-taches/rendez-vous/{id}/desarchiver", name="appointment_unarchived_admin")
    * return RedirectResponse
    */
    public function archivedAppointment(Appointment $appointment): Response {

        $rep = $this->getDoctrine()
        ->getRepository(Appointment::class)
        ->setAppointmentForUnArchived($appointment->getId());
    
        return $this->redirectToRoute("task_list_archived_admin"); 
    }

    // ------------------------------
    // ----------- Quote ------------
    // ------------------------------

   /**
    * @Route("/admin/liste-des-taches/devis/ajouter", name="task_quote_add_admin")
    */
    public function addTaskQuote(Request $request): Response {
        $quoteAdd = new Quote();
        $form = $this->createForm(AdminTaskQuoteAddType::class, $quoteAdd);
        $notification = null;
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($quoteAdd);
            $this->entityManager->flush();
            $notification = 'Le devis a bien été ajoutée';
            $quoteAdd = new Quote();
            $form = $this->createForm(AdminTaskQuoteAddType::class, $quoteAdd);
        }
            return $this->render('back/task/quote/add.html.twig', [
                'form_admin_task_quote_add' => $form->createView(),
                'notification' => $notification
            ]);
        }

    /**
    * @Route("/admin/liste-des-taches/devis/{id}/modifier", name="task_quote_modify_admin")
    */
    public function modifyQuote(Request $request, Quote $quoteModify): Response
    {
        $form = $this->createForm(AdminTaskQuoteModifyType::class, $quoteModify);
        $notification = null;
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $quoteModify = $form->getData();
            $this->entityManager->persist($quoteModify);
            $this->entityManager->flush();
            $notification = 'Le devis a bien été mise à jour !';
            $form = $this->createForm(AdminTaskQuoteModifyType::class, $quoteModify);
        }
        return $this->render('back/task/quote/modify.html.twig',[
            'form_quote_modify_admin' => $form->createView(),
            'notification' => $notification
        ]);   
    }

    /**
    * @Route("/admin/liste-des-taches/devis/{id}/supprimer", name="task_quote_detete_admin")
    * @param Quote $quoteDelete
    * return RedirectResponse
    */
    public function deleteAppointment(Quote $quoteDelete): RedirectResponse {
        $em = $this->getDoctrine()->getManager();
        $em->remove($quoteDelete);
        $em->flush();

        return $this->redirectToRoute("task_list_admin");
        ;   
    }

    /**
    * @Route("/admin/liste-des-taches/devis/{id}/archiver", name="quote_archived_admin")
    * return RedirectResponse
    */
    public function unarchivedQuote(Quote $quote): Response {

        $rep = $this->getDoctrine()
        ->getRepository(Quote::class)
        ->setQuoteForArchived($quote->getId());
    
        return $this->redirectToRoute("task_list_admin"); 
    }

        /**
    * @Route("/admin/liste-des-taches/devis/{id}/desarchiver", name="quote_unarchived_admin")
    * return RedirectResponse
    */
    public function archivedQuote(Quote $quote): Response {

        $rep = $this->getDoctrine()
        ->getRepository(Quote::class)
        ->setQuoteForUnArchived($quote->getId());
    
        return $this->redirectToRoute("task_list_archived_admin"); 
    }

    // ------------------------------
    // ------- Download Tasks -------
    // ------------------------------

        /**
     * @Route("/admin/liste-des-taches/telecharger", name="task_list_download_admin")
     */
    public function taskDownload(TaskRepository $taskAdmin, AppointmentRepository $rendezvousAdmin, QuoteRepository $quoteAdmin, Task2Repository $task2Admin)
    {
        $pdfOptions = New Options();
        $pdfOptions->set('defaultFont', 'Gotham');
        $pdfOptions->setIsRemoteEnabled(true);
        // la partie ssl de la vidéo a été supprimé 
        $dompdf = new Dompdf($pdfOptions);
        $html 	= '<img width="220" height="220" src="../assets/images/logo-to-do-list-vert.png">';
        $html = $this->renderView('back/task/download.html.twig', [
            'task' => $taskAdmin->findAll(),
            'rendezvous' => $rendezvousAdmin->findAll(),
            'quote' => $quoteAdmin->findAll(),
            'task2' => $task2Admin->findAll(),
        ]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $file = 'liste-des-tâches' . '.pdf';

        $dompdf->stream($file, [
            'Attachment' => true
        ]);

        return new Response('', 200, [
            'Content-Type' => 'application/pdf',
          ]);
    }

}