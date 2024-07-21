<?php

namespace App\NotificationPublisher\Infrastructure\Push;
use App\NotificationPublisher\Domain\Service\NotificationSenderInterface;

class PushySender implements NotificationSenderInterface
{
    public function send(string $userId, string $message): bool
    {
        $result = (bool)random_int(0, 1);
        if ($result) {
            var_dump('Pushy notification sent');
        } else {
            var_dump('Pushy notification not sent');
        }
        return $result;
    }
}
