<?php

namespace App\NotificationPublisher\Domain\Service;

interface NotificationSenderInterface
{
    public function send(string $userId, string $message): bool;
    public function supports(string $channel, bool $isSecondary = false): bool;
}
