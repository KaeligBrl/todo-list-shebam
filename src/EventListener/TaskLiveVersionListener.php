<?php

namespace App\EventListener;

use App\Entity\Task;
use App\Service\TaskLiveVersionService;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\PersistentCollection;

#[AsDoctrineListener(event: Events::onFlush)]
class TaskLiveVersionListener
{
    public function __construct(private readonly TaskLiveVersionService $taskLiveVersionService)
    {
    }

    public function onFlush(OnFlushEventArgs $args): void
    {
        $unitOfWork = $args->getObjectManager()->getUnitOfWork();

        foreach ($unitOfWork->getScheduledEntityInsertions() as $entity) {
            if ($entity instanceof Task) {
                $this->taskLiveVersionService->bump();

                return;
            }
        }

        foreach ($unitOfWork->getScheduledEntityUpdates() as $entity) {
            if ($entity instanceof Task) {
                $this->taskLiveVersionService->bump();

                return;
            }
        }

        foreach ($unitOfWork->getScheduledEntityDeletions() as $entity) {
            if ($entity instanceof Task) {
                $this->taskLiveVersionService->bump();

                return;
            }
        }

        foreach ($unitOfWork->getScheduledCollectionUpdates() as $collection) {
            if ($collection instanceof PersistentCollection && $collection->getOwner() instanceof Task) {
                $this->taskLiveVersionService->bump();

                return;
            }
        }

        foreach ($unitOfWork->getScheduledCollectionDeletions() as $collection) {
            if ($collection instanceof PersistentCollection && $collection->getOwner() instanceof Task) {
                $this->taskLiveVersionService->bump();

                return;
            }
        }
    }
}
