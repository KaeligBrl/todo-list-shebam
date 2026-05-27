<?php

namespace App\Service;

use App\Entity\Task;
use App\Entity\User;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class TaskLiveVersionService
{
    private string $versionFile;
    private int $draftTtlMs = 30000;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->versionFile = rtrim($parameterBag->get('kernel.project_dir'), DIRECTORY_SEPARATOR)
            . DIRECTORY_SEPARATOR . 'var'
            . DIRECTORY_SEPARATOR . 'task-live-version.txt';
    }

    public function getVersion(): int
    {
        $state = $this->readState();

        return (int) ($state['version'] ?? 0);
    }

    public function getLastChange(): ?array
    {
        $state = $this->readState();

        return isset($state['last_change']) && is_array($state['last_change']) ? $state['last_change'] : null;
    }

    public function getDraftVersion(): int
    {
        $state = $this->readState();

        return (int) ($state['draft_version'] ?? 0);
    }

    public function getDrafts(): array
    {
        $state = $this->readState();
        $drafts = isset($state['drafts']) && is_array($state['drafts']) ? $state['drafts'] : [];
        $now = (int) floor(microtime(true) * 1000);
        $activeDrafts = [];

        foreach ($drafts as $scope => $draftState) {
            if (!is_array($draftState)) {
                continue;
            }

            $updatedAt = (int) ($draftState['updated_at'] ?? 0);
            if ($updatedAt > 0 && ($now - $updatedAt) <= $this->draftTtlMs) {
                $activeDrafts[(string) $scope] = $draftState;
            }
        }

        return $activeDrafts;
    }

    public function bump(): int
    {
        $version = (int) floor(microtime(true) * 1000);
        $state = $this->readState();
        $state['version'] = $version;
        $this->writeState($state);

        return $version;
    }

    public function recordChange(string $action, Task $task, ?User $actor): int
    {
        $version = (int) floor(microtime(true) * 1000);
        $state = $this->readState();

        $state['version'] = $version;
        $state['last_change'] = [
            'action' => $action,
            'task_id' => $task->getId(),
            'task_subject' => $this->safeText((string) $task->getObject()),
            'actor' => [
                'id' => $actor?->getId(),
                'firstname' => $this->safeText($actor?->getFirstname() ?? 'Systeme'),
                'lastname' => $this->safeText($actor?->getLastname() ?? ''),
                'email' => $this->safeText($actor?->getEmail() ?? ''),
                'profile_picture_url' => $this->buildProfilePictureUrl($actor),
            ],
        ];

        $this->writeState($state);

        return $version;
    }

    public function recordDraft(string $scope, array $draft, ?User $actor, ?string $tabId = null): int
    {
        $version = (int) floor(microtime(true) * 1000);
        $state = $this->readState();

        $state['draft_version'] = $version;
        $state['drafts'] = isset($state['drafts']) && is_array($state['drafts']) ? $state['drafts'] : [];
        $state['drafts'][$scope] = [
            'version' => $version,
            'updated_at' => $version,
            'scope' => $this->safeText($scope),
            'tab_id' => $tabId ? $this->safeText($tabId) : null,
            'actor' => [
                'id' => $actor?->getId(),
                'firstname' => $this->safeText($actor?->getFirstname() ?? 'Systeme'),
                'lastname' => $this->safeText($actor?->getLastname() ?? ''),
                'email' => $this->safeText($actor?->getEmail() ?? ''),
                'profile_picture_url' => $this->buildProfilePictureUrl($actor),
            ],
            'draft' => $this->normalizeDraft($draft),
        ];

        $this->writeState($state);

        return $version;
    }

    public function clearDraft(string $scope): int
    {
        $version = (int) floor(microtime(true) * 1000);
        $state = $this->readState();
        $state['drafts'] = isset($state['drafts']) && is_array($state['drafts']) ? $state['drafts'] : [];

        if (isset($state['drafts'][$scope])) {
            unset($state['drafts'][$scope]);
        }

        $state['draft_version'] = $version;
        $this->writeState($state);

        return $version;
    }

    private function buildProfilePictureUrl(?User $actor): ?string
    {
        if (!$actor || !$actor->getProfilePicture()) {
            return null;
        }

        return '/' . ltrim($actor->getProfilePicture(), '/');
    }

    private function readState(): array
    {
        if (!is_file($this->versionFile)) {
            return ['version' => 0, 'last_change' => null, 'draft_version' => 0, 'drafts' => []];
        }

        $raw = @file_get_contents($this->versionFile);
        if ($raw === false) {
            return ['version' => 0, 'last_change' => null, 'draft_version' => 0, 'drafts' => []];
        }

        $trimmed = trim($raw);
        if ($trimmed === '') {
            return ['version' => 0, 'last_change' => null, 'draft_version' => 0, 'drafts' => []];
        }

        if (ctype_digit($trimmed)) {
            return ['version' => (int) $trimmed, 'last_change' => null, 'draft_version' => 0, 'drafts' => []];
        }

        $decoded = json_decode($trimmed, true);
        if (!is_array($decoded)) {
            return ['version' => 0, 'last_change' => null, 'draft_version' => 0, 'drafts' => []];
        }

        return [
            'version' => (int) ($decoded['version'] ?? 0),
            'last_change' => isset($decoded['last_change']) && is_array($decoded['last_change']) ? $decoded['last_change'] : null,
            'draft_version' => (int) ($decoded['draft_version'] ?? 0),
            'drafts' => isset($decoded['drafts']) && is_array($decoded['drafts']) ? $decoded['drafts'] : [],
        ];
    }

    private function writeState(array $state): void
    {
        @file_put_contents($this->versionFile, (string) json_encode($state, JSON_UNESCAPED_SLASHES), LOCK_EX);
    }

    private function safeText(string $value): string
    {
        if ($value === '') {
            return '';
        }

        if (preg_match('//u', $value) === 1) {
            return $value;
        }

        $converted = @iconv('ISO-8859-1', 'UTF-8//IGNORE', $value);

        return $converted === false ? '' : $converted;
    }

    private function normalizeDraft(array $draft): array
    {
        $normalized = [];

        foreach ($draft as $key => $value) {
            if (is_array($value)) {
                $normalized[$key] = $this->normalizeDraft($value);
                continue;
            }

            if (is_string($value)) {
                $normalized[$key] = $this->safeText($value);
                continue;
            }

            $normalized[$key] = $value;
        }

        return $normalized;
    }
}
