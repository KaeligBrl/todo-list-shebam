<?php

namespace App\Controller\Front\NextWeek\Appointment;

use App\Entity\Appointment;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteController extends AbstractController
{

    /**
     * @Route("/semaine-suivante/rendez-vous/supprimer/{id}", name="delete_nw_appointment")
     * @param Appointment $appointmentDelete
     * return RedirectResponse
     */
    public function deleteAppointment(Appointment $appointmentDelete): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($appointmentDelete);
        $em->flush();

        return $this->redirectToRoute("next_week_appointment");
    }
}
