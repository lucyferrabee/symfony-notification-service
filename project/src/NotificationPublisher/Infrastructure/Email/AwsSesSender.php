<?php

namespace App\NotificationPublisher\Infrastructure\Push;
use App\NotificationPublisher\Domain\Service\NotificationSenderInterface;

class AwsSesSender implements NotificationSenderInterface
{
    public function send(string $userId, string $message): bool
    {
        // TODO: implementation of secondary email provider
        $result = (bool)random_int(0, 1);
        if ($result) {
            var_dump('Aws SES notification sent');
        } else {
            var_dump('Aws SES notification not sent');
        }
        return $result;
    }
}
