<?php

namespace App\Controller\Back\Quote;

use App\Entity\Quote;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteCurrentWeekController extends AbstractController
{

    /**
     * @Route("/semaine-actuelle/devis/supprimer/id={id}", name="delete_quote_cw")
     * @param Quote $quoteDelete
     * return RedirectResponse
     */
    public function deleteAppointment(Quote $quoteDelete): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($quoteDelete);
        $em->flush();

        return $this->redirectToRoute("list_cw_mission_back");;
    }

}