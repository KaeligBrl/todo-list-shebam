<?php

namespace App\Controller\Front\NextWeek;

use App\Entity\Quote;
use App\Repository\TaskRepository;
use App\Repository\QuoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AppointmentRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Front\Quote\AddQuoteNextWeekType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Front\Quote\ModifyQuoteNextWeekType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuoteController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/semaine-suivante/devis", name="next_week_quote")
     */
    public function index(QuoteRepository $quoteList, Request $request): Response
    {

        $quoteAdd = new Quote();
        $formquote = $this->createForm(AddQuoteNextWeekType::class, $quoteAdd);
        $notification = null;
        $formquote->handleRequest($request);
        if ($formquote->isSubmitted() && $formquote->isValid()) {
            $this->entityManager->persist($quoteAdd);
            $this->entityManager->flush();
            return $this->redirectToRoute("home");
        }

        return $this->render('front/next_week/quote/list.html.twig', [

            'quote' => $quoteList->findBy([], ['position' => 'ASC']),
            'form_quote_nw_add' => $formquote->createView(),
            'notification' => $notification,
        ]);
    }

    /**
     * @Route("/semaine-suivante/devis/modifier/{id}", name="modify_quote_nw")
     */
    public function modifyQuote(Request $request, Quote $quoteModify): Response
    {
        $form = $this->createForm(ModifyQuoteNextWeekType::class, $quoteModify);
        $notification = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $quoteModify = $form->getData();
            $this->entityManager->persist($quoteModify);
            $this->entityManager->flush();
            $notification = 'Le devis a bien été mis à jour !';
            $form = $this->createForm(ModifyQuoteNextWeekType::class, $quoteModify);
        }
        return $this->render('front/next_week/quote/modify.html.twig', [
            'form_quote_nw_modify' => $form->createView(),
            'notification' => $notification,
            'quote' => $quoteModify
        ]);
    }

    /**
     * @Route("/semaine-suivante/devis/supprimer/{id}", name="delete_quote_nw")
     * @param Quote $quoteDelete
     * return RedirectResponse
     */
    public function deleteQuote(Quote $quoteDelete): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($quoteDelete);
        $em->flush();

        return $this->redirectToRoute("next_week_quote");
    }

    /**
     * @Route("/semaine-suivante/devis/basculer/semaine-actuelle/{id}", name="change_quote_nw_to_nw")
     * return RedirectResponse
     */
    public function changeQuoteCurrentToNextWeek(Quote $quoteChange): Response
    {
        $rep = $this->getDoctrine()
            ->getRepository(Quote::class)
            ->setChangeQuoteNextWeekToCurrentWeek($quoteChange->getId());

        return $this->redirectToRoute("next_week_quote");
    }

    /**
     * @Route("/reorder", name="home_nw_reorder_row")
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
}
