<?php

namespace App\Controller\Back;

use App\Entity\Quote;
use App\Entity\Tache;
use App\Entity\Statut;
use App\Entity\Rendezvous;
use App\Form\Back\AdminTaskQuoteAddType;
use App\Repository\QuoteRepository;
use App\Repository\TacheRepository;
use App\Form\Back\AdminTaskAddType;
use App\Form\AdminTaskQuoteModifyType;
use App\Form\Back\AdminTaskModifyType;
use App\Repository\RendezvousRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Back\AdminTaskAddStatutType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\Back\AdminTaskAppointmentAddType;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Back\AdminTaskAppointmentModifyType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminTaskController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
    $this->entityManager = $entityManager;
    }
    /**
     * @Route("/admin/liste-des-taches/", name="task_list_admin")
     */
    public function listTask(TacheRepository $tacheAdmin, RendezvousRepository $rendezvousAdmin, QuoteRepository $quoteAdmin): Response
    {
        return $this->render('back/task/list.html.twig', [
            'taches' => $tacheAdmin->findAll(),
            'rendezvous' => $rendezvousAdmin->findAll(),
            'quote' => $quoteAdmin->findAll(),
        ]);
    }

    /**
     * @Route("/admin/liste-des-taches/{id}/supprimer", name="task_list_detete_admin")
     * @param Tache $tache
     * return RedirectResponse
     */
    public function deleteTask(Tache $tache): RedirectResponse {
        $em = $this->getDoctrine()->getManager();
        $em->remove($tache);
        $em->flush();

        return $this->redirectToRoute("task_list_admin");
    }
    /**
     * @Route("/admin/liste-des-taches/ajouter", name="task_list_add_admin")
     */
    public function index(Request $request): Response {
        $tacheAdd = new Tache();
        $form = $this->createForm(AdminTaskAddType::class, $tacheAdd);
        $notification = null;
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($tacheAdd);
            $this->entityManager->flush();
            $notification = 'La tâche a bien été ajoutée';
            $tacheAdd = new Tache();
            $form = $this->createForm(AdminTaskAddType::class, $tacheAdd);
        }
            return $this->render('back/task/add.html.twig', [
                'form_admin_task_list_add' => $form->createView(),
                'notification' => $notification
            ]);
        }

    /**
     * @Route("/admin/liste-des-taches/{id}/modifier", name="task_list_modify_admin")
     */
    public function modifyTask(Request $request, Tache $tacheModify): Response
    {
        $form = $this->createForm(AdminTaskModifyType::class, $tacheModify);
        $notification = null;
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $tacheModify = $form->getData();
            $this->entityManager->persist($tacheModify);
            $this->entityManager->flush();
            $notification = 'Tâche mise à jour !';
            $form = $this->createForm(AdminTaskModifyType::class, $tacheModify);
        }
        return $this->render('back/task/modify.html.twig',[
            'form_task_list_modify_admin' => $form->createView(),
            'notification' => $notification
        ]);   
    }

    /**
     * @Route("/admin/liste-des-taches/rendez-vous/ajouter", name="task_appointment_add_admin")
     */
    public function addTaskAppointment(Request $request): Response {
        $rendezvousAdd = new Rendezvous();
        $form = $this->createForm(AdminTaskAppointmentAddType::class, $rendezvousAdd);
        $notification = null;
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($rendezvousAdd);
            $this->entityManager->flush();
            $notification = 'Le rendez-vous a bien été ajoutée';
            $rendezvousAdd = new Rendezvous();
            $form = $this->createForm(AdminTaskAppointmentAddType::class, $rendezvousAdd);
        }
            return $this->render('back/task/appointment/add.html.twig', [
                'form_admin_task_appointment_add' => $form->createView(),
                'notification' => $notification
            ]);
        }

    /**
     * @Route("/admin/liste-des-taches/rendez-vous/{id}/modifier", name="task_appointment_modify_admin")
     */
    public function modifyAppointment(Request $request, Rendezvous $appointmentModify): Response
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
            'form_task_appointment_admin' => $form->createView(),
            'notification' => $notification
        ]);   
    }

    /**
     * @Route("/admin/liste-des-taches/rendez-vous/{id}/supprimer", name="task_appointment_detete_admin")
     * @param Rendezvous $rendezvousDelete
     * return RedirectResponse
     */
    public function deleteQuote(Rendezvous $rendezvousDelete): RedirectResponse {
        $em = $this->getDoctrine()->getManager();
        $em->remove($rendezvousDelete);
        $em->flush();

        return $this->redirectToRoute("task_list_admin");
        ;   
    }

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
            'form_task_quote_modify_admin' => $form->createView(),
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
}