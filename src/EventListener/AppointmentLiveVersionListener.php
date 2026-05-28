<?php

namespace App\EventListener;

use App\Entity\Appointment;
use App\Entity\User;
use App\Service\TaskLiveVersionService;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Events;
use Symfony\Bundle\SecurityBundle\Security;

#[AsDoctrineListener(event: Events::onFlush)]
class AppointmentLiveVersionListener
{
    public function __construct(
        private readonly TaskLiveVersionService $taskLiveVersionService,
        private readonly Security $security,
    )
    {
    }

    public function onFlush(OnFlushEventArgs $args): void
    {
        $entityManager = $args->getObjectManager();
        if (!$entityManager instanceof EntityManagerInterface) {
            return;
        }

        $unitOfWork = $entityManager->getUnitOfWork();

        foreach ($unitOfWork->getScheduledEntityInsertions() as $entity) {
            if ($entity instanceof Appointment) {
                $this->taskLiveVersionService->recordAppointmentChange('created', $entity, $this->getActor());

                return;
            }
        }

        foreach ($unitOfWork->getScheduledEntityUpdates() as $entity) {
            if ($entity instanceof Appointment) {
                $this->taskLiveVersionService->recordAppointmentChange('updated', $entity, $this->getActor());

                return;
            }
        }

        foreach ($unitOfWork->getScheduledEntityDeletions() as $entity) {
            if ($entity instanceof Appointment) {
                $this->taskLiveVersionService->recordAppointmentChange('deleted', $entity, $this->getActor());

                return;
            }
        }
    }

    private function getActor(): ?User
    {
        $user = $this->security->getUser();

        return $user instanceof User ? $user : null;
    }
}
