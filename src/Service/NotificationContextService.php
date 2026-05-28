<?php

namespace App\Service;

class NotificationContextService
{
    public function format(string $context, string $message): string
    {
        $context = trim($context);
        $message = trim($message);

        if ($context === '') {
            return $message;
        }

        if ($message === '') {
            return $context;
        }

        return $context . ' - ' . $message;
    }
}
