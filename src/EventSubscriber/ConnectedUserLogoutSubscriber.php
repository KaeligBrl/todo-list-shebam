<?php

namespace App\EventSubscriber;

use App\Entity\User;
use App\Service\ConnectedUsersService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\Event\LogoutEvent;

class ConnectedUserLogoutSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly ConnectedUsersService $connectedUsersService)
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            LogoutEvent::class => 'onLogout',
        ];
    }

    public function onLogout(LogoutEvent $event): void
    {
        $user = $event->getToken()?->getUser();
        if (!$user instanceof User || !$user->getId()) {
            return;
        }

        $this->connectedUsersService->removeUserById((int) $user->getId());
    }
}
