<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ConnectedUsersService
{
    private string $storageFile;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->storageFile = rtrim((string) $parameterBag->get('kernel.project_dir'), DIRECTORY_SEPARATOR)
            . DIRECTORY_SEPARATOR . 'var'
            . DIRECTORY_SEPARATOR . 'connected-users.json';
    }

    public function touchUser(User $user): void
    {
        $state = $this->readState();
        $now = time();

        $state[(string) $user->getId()] = [
            'id' => $user->getId(),
            'firstname' => (string) ($user->getFirstname() ?? ''),
            'lastname' => (string) ($user->getLastname() ?? ''),
            'profile_picture_url' => $this->buildProfilePictureUrl($user->getProfilePicture()),
            'last_seen' => $now,
        ];

        $this->writeState($state);
    }

    public function getActiveUsers(int $ttlSeconds = 120): array
    {
        $state = $this->readState();
        $now = time();
        $active = [];
        $changed = false;

        foreach ($state as $userId => $userState) {
            if (!is_array($userState)) {
                $changed = true;
                unset($state[$userId]);
                continue;
            }

            $lastSeen = (int) ($userState['last_seen'] ?? 0);
            if ($lastSeen <= 0 || ($now - $lastSeen) > $ttlSeconds) {
                $changed = true;
                unset($state[$userId]);
                continue;
            }

            $active[] = [
                'id' => (int) ($userState['id'] ?? 0),
                'firstname' => (string) ($userState['firstname'] ?? ''),
                'lastname' => (string) ($userState['lastname'] ?? ''),
                'profile_picture_url' => $userState['profile_picture_url'] ?? null,
                'last_seen' => $lastSeen,
            ];
        }

        usort($active, static fn(array $a, array $b): int => ($b['last_seen'] <=> $a['last_seen']));

        if ($changed) {
            $this->writeState($state);
        }

        return $active;
    }

    public function removeUserById(int $userId): void
    {
        $state = $this->readState();
        $key = (string) $userId;

        if (!array_key_exists($key, $state)) {
            return;
        }

        unset($state[$key]);
        $this->writeState($state);
    }

    private function readState(): array
    {
        if (!is_file($this->storageFile)) {
            return [];
        }

        $raw = @file_get_contents($this->storageFile);
        if ($raw === false) {
            return [];
        }

        $decoded = json_decode((string) $raw, true);
        if (!is_array($decoded)) {
            return [];
        }

        return $decoded;
    }

    private function writeState(array $state): void
    {
        @file_put_contents($this->storageFile, (string) json_encode($state, JSON_UNESCAPED_SLASHES), LOCK_EX);
    }

    private function buildProfilePictureUrl(?string $profilePicture): ?string
    {
        $path = str_replace('\\', '/', trim((string) $profilePicture));
        if ($path === '') {
            return null;
        }

        if (preg_match('#^https?://#i', $path) === 1) {
            return $path;
        }

        return '/' . ltrim($path, '/');
    }
}
