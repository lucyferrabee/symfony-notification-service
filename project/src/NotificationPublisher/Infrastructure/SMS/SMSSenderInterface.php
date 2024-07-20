<?php

namespace App\NotificationPublisher\Infrastructure\SMS;

interface SmsSenderInterface
{
    public function send(string $userId, string $message): void;
}
