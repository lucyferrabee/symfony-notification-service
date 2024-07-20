<?php

namespace App\NotificationPublisher\Application\Handler;

use App\NotificationPublisher\Application\Service\NotificationSender;
use App\NotificationPublisher\Domain\Model\Notification;

class SendNotificationHandler
{
    private NotificationSender $notificationSender;

    public function __construct(NotificationSender $notificationSender)
    {
        $this->notificationSender = $notificationSender;
    }

    public function handle(Notification $notification)
    {
        $this->notificationSender->send(
            $notification->getUserId(),
            $notification->getMessage(),
            $notification->getChannel()
        );
    }
}
