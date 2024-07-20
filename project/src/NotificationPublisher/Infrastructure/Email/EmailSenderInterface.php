<?php

namespace App\NotificationPublisher\Infrastructure\Email;

interface EmailSenderInterface
{
    public function send(string $userId, string $message): void;
}
