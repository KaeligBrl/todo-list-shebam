<?php

namespace App\Controller\Front;

use App\Entity\Task;
use App\Entity\Quote;
use App\Entity\Appointment;
use App\Repository\TaskRepository;
use App\Repository\QuoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AppointmentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Front\Quote\AddQuoteCurrentWeekType;
use App\Form\Front\Task\AddTaskP1CurrentWeekType;
use App\Form\Front\Task\AddTaskP2CurrentWeekType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Form\Front\Appointment\AddAppointmentCurrentWeekType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class CurentWeekController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/semaine-actuelle", name="current_week")
     */
    public function index(TaskRepository $taskList, AppointmentRepository $appointmentList, QuoteRepository $quoteList, Request $request, AuthenticationUtils $authenticationUtils): Response
    {
    
        $taskAdd = new Task();
        $form_p1 = $this->createForm(AddTaskP1CurrentWeekType::class, $taskAdd);
        $notification = null;
        $form_p1->handleRequest($request);
        if ($form_p1->isSubmitted() && $form_p1->isValid()) {
            $this->entityManager->persist($taskAdd);
            $this->entityManager->flush();
            return $this->redirectToRoute("home");
        }

        $taskp2Add = new Task();
        $form_p2 = $this->createForm(AddTaskP2CurrentWeekType::class, $taskp2Add);
        $notification = null;
        $form_p2->handleRequest($request);
        if ($form_p2->isSubmitted() && $form_p2->isValid()) {
            $this->entityManager->persist($taskp2Add);
            $this->entityManager->flush();
            return $this->redirectToRoute("home");
        }

        $appointmentAdd = new Appointment();
        $formappointment = $this->createForm(AddAppointmentCurrentWeekType::class, $appointmentAdd);
        $notification = null;
        $formappointment->handleRequest($request);
        if ($formappointment->isSubmitted() && $formappointment->isValid()) {
            $this->entityManager->persist($appointmentAdd);
            $this->entityManager->flush();
            return $this->redirectToRoute("home");
            
        }

        $quoteAdd = new Quote();
        $formquote = $this->createForm(AddQuoteCurrentWeekType::class, $quoteAdd);
        $notification = null;
        $formquote->handleRequest($request);
        if ($formquote->isSubmitted() && $formquote->isValid()) {
            $this->entityManager->persist($quoteAdd);
            $this->entityManager->flush();
            return $this->redirectToRoute("home");
        }


        return $this->render('front/home/index.html.twig', [
            'task' => $taskList->findBy([], ['position' => 'ASC']),
            'appointment' => $appointmentList->findBy([], ['hoursappointment' => 'ASC']),
            'quote' => $quoteList->findBy([], ['position' => 'ASC']),
            'form_task_p1_cw_add_front' => $form_p1->createView(),
            'form_task_p2_cw_add_front' => $form_p2->createView(),
            'form_appointment_cw_add_front' => $formappointment->createView(),
            'form_quote_cw_add_front' => $formquote->createView(),
            'notification' => $notification,
        ]);
    }

    /**
     * @Route("/tache/{id}/supprimer", name="delete_task_cw_front")
     * @param Task $taskDelete
     * return RedirectResponse
     */
    public function deleteTask(Task $taskDelete): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($taskDelete);
        $em->flush();

        return $this->redirectToRoute("home");
    }

    /**
     * @Route("/rendez-vous/{id}/supprimer", name="detete_appointment_cw_front")
     * @param Appointment $appointmentDelete
     * return RedirectResponse
     */
    public function deleteAppointment(Appointment $appointmentDelete): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($appointmentDelete);
        $em->flush();

        return $this->redirectToRoute("home");
    }

    /**
     * @Route("/devis/{id}/supprimer", name="delete_quote_cw_front")
     * @param Quote $quoteDelete
     * return RedirectResponse
     */
    public function deleteQuote(Quote $quoteDelete): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($quoteDelete);
        $em->flush();

        return $this->redirectToRoute("home");
    }

    /**
     * @Route("/basculement-vers-p1/id={id}", name="task_cw_change_to_p1_front")
     * return RedirectResponse
     */
    public function changeTaskToP1Front(Task $task): Response
    {

        $rep = $this->getDoctrine()
            ->getRepository(Task::class)
            ->setChangeTaskForP1CurrentWeek($task->getId());

        return $this->redirectToRoute("home");
    }

    /**
     * @Route("/basculement-vers-p2/id={id}", name="task_cw_change_to_p2_front")
     * return RedirectResponse
     */
    public function changeTaskToP2Front(Task $task): Response
    {

        $rep = $this->getDoctrine()
            ->getRepository(Task::class)
            ->setChangeTaskForP2CurrentWeek($task->getId());

        return $this->redirectToRoute("home");
    }

    /**
     * @Route("/basculer-p1-en-semaine-suivante/id={id}", name="task_change_p1_cw_to_p1_nw_front")
     * return RedirectResponse
     */
    public function changeTaskP1CurrentWeekToP1NextWeek(Task $task): Response
    {
        $rep = $this->getDoctrine()
            ->getRepository(Task::class)
            ->setChangeTaskP1CurrentWeekToP1NextWeek($task->getId());

        return $this->redirectToRoute("home");
    }

    /**
     * @Route("/basculer-p2-en-semaine-suivante/id={id}", name="task_change_p2_cw_to_p2_nw_front")
     * return RedirectResponse
     */
    public function changeTaskP2CurrentWeekToP2NextWeek(Task $task): Response
    {
        $rep = $this->getDoctrine()
            ->getRepository(Task::class)
            ->setChangeTaskP2CurrentWeekToP2NextWeek($task->getId());

        return $this->redirectToRoute("home");
    }

    /**
     * @Route("/basculer/rendez-vous-en-semaine-suivante/id={id}", name="change_appointment_cw_to_nw_front")
     * return RedirectResponse
     */
    public function changeAppointmentNextWeekToCurrentWeek(Appointment $appointmentChange): Response
    {
        $rep = $this->getDoctrine()
            ->getRepository(Appointment::class)
            ->setChangeAppointmentCurrentWeekToNextWeek($appointmentChange->getId());

        return $this->redirectToRoute("home");
    }

    /**
     * @Route("/basculer/devis-en-semaine-suivante/id={id}", name="change_quote_cw_to_nw_front")
     * return RedirectResponse
     */
    public function changeQuoteCurrentToNextWeek(Quote $quoteChange): Response
    {
        $rep = $this->getDoctrine()
            ->getRepository(Quote::class)
            ->setChangeQuoteCurrentWeekToNextWeek($quoteChange->getId());

        return $this->redirectToRoute("home");
    }

    /**
     * @Route("/reorder", name="home_cw_reorder_row")
     */
    public function reorderTaskP1Row(Request $request, TaskRepository $taskRow, AppointmentRepository $appointmentRow, QuoteRepository $quoteRow)
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

            case '3':
                foreach (json_decode($request->request->get("table"), true) as $row) {
                    $quote = $quoteRow->find($row['id']);
                    $quote->setPosition($cpt);
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
     * @Route("/deconnexion", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
