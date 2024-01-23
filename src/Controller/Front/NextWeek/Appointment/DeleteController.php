<?php

namespace App\Controller\Front\NextWeek\Appointment;

use App\Entity\Appointment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteController extends AbstractController
{
    /**
     * @Route("/semaine-suivante/rendez-vous/supprimer/{id}", name="delete_nw_appointment")
     */
    public function deleteAppointment(Appointment $appointmentDelete, EntityManagerInterface $entityManager): RedirectResponse
    {
        $entityManager->remove($appointmentDelete);
        $entityManager->flush();

        return $this->redirectToRoute("next_week_appointment");
    }
}
