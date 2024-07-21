<?php

namespace App\NotificationPublisher\Infrastructure\Push;
use App\NotificationPublisher\Domain\Service\NotificationSenderInterface;

class FirebaseSender implements NotificationSenderInterface
{
    public function send(string $userId, string $message): bool
    {
        // TODO: implementation of secondary push provider
        $result = (bool)random_int(0, 1);
        if ($result) {
            var_dump('Firebase notification sent');
        } else {
            var_dump('Firebase notification not sent');
        }
        return $result;
    }
}
