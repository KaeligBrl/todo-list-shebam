<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class TaskLiveVersionService
{
    private string $versionFile;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->versionFile = rtrim($parameterBag->get('kernel.project_dir'), DIRECTORY_SEPARATOR)
            . DIRECTORY_SEPARATOR . 'var'
            . DIRECTORY_SEPARATOR . 'task-live-version.txt';
    }

    public function getVersion(): int
    {
        if (!is_file($this->versionFile)) {
            return 0;
        }

        $raw = @file_get_contents($this->versionFile);
        if ($raw === false) {
            return 0;
        }

        return (int) trim($raw);
    }

    public function bump(): int
    {
        $version = (int) floor(microtime(true) * 1000);
        @file_put_contents($this->versionFile, (string) $version, LOCK_EX);

        return $version;
    }
}
