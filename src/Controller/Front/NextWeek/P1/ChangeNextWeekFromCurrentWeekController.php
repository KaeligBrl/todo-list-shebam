<?php

namespace App\Controller\Front\NextWeek\P1;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AppointmentRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Front\Task\AddTaskP1NextWeekType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChangeNextWeekFromCurrentWeekController extends AbstractController
{

    /**
     * @Route("/semaine-suivante/changer-vers-semaine-actuelle/", name="mission_nw_change_to_cw_front")
     */
    public function changeTaskToCurrentWeek(TaskRepository $taskRepository, AppointmentRepository $appointmentRepository): Response
    {
        $taskRepository->setRemoveTask();
        $appointmentRepository->setRemoveAppointment();
        $taskRepository->setchangeTaskToCurrentWeek();
        $appointmentRepository->setchangeAppointmentToCurrentWeek();

        return $this->redirectToRoute("next_week_p1");
    }

}
