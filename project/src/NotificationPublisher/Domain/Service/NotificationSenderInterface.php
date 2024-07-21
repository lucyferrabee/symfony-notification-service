<?php

namespace App\NotificationPublisher\Domain\Service;

interface NotificationSenderInterface
{
    public function send(string $userId, string $message, string $channel): bool;
    public function supports(string $channel): bool;
}