<?php

namespace App\Controller\Back\Appointment;

use App\Entity\Appointment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Form\Front\Appointment\AddAppointmentNextWeekType;
use App\Form\Front\Appointment\ModifyAppointmentNextWeekType;
use App\Form\Front\Appointment\ModifyAppointmentCurrentWeekType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CurrentWeekDeleteController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    #[Route('/semaine-actuelle/rendez-vous/supprimer/id={id}', name: 'delete_appointment_cw_back')]
    public function deleteQuoteCurrentWeek(Appointment $appointmentDelete, EntityManagerInterface $entityManager): RedirectResponse
    {

        $em = $entityManager;
        $entityManager->remove($appointmentDelete);
        $entityManager->flush();

        return $this->redirectToRoute("current_week");;
    }

}
