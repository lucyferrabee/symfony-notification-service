<?php

namespace App\NotificationPublisher\Application\Service;

use App\NotificationPublisher\Domain\Service\NotificationSenderInterface;
use InvalidArgumentException;

class NotificationSender
{
    private iterable $notificationSenders;

    public function __construct(iterable $notificationSenders)
    {
        $this->notificationSenders = $notificationSenders;
    }

    public function send(string $userId, string $message, string $channel)
    {
        foreach ($this->notificationSenders as $sender) {
            try {
                $sender->send($userId, $message, $channel);
                return;
            } catch (InvalidArgumentException $e) {
                // This sender does not support the provided channel, continue to the next one
            }
        }

        throw new InvalidArgumentException('No sender supports the given channel');
    }
}
