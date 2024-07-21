<?php

namespace App\NotificationPublisher\Infrastructure\Push;
use App\NotificationPublisher\Domain\Service\NotificationSenderInterface;

class PushySender implements NotificationSenderInterface
{
    public function send(string $userId, string $message, string $channel): bool
    {
        if ($channel !== 'push') {
            throw new \InvalidArgumentException('Unsupported notification channel');
        }

        $result = (bool)random_int(0, 1);
        if ($result) {
            var_dump('Firebase notification sent');
        } else {
            var_dump('Firebase notification not sent');
        }
        return $result;
    }

    public function supports(string $channel): bool
    {
        return $channel === 'push';
    }
}
