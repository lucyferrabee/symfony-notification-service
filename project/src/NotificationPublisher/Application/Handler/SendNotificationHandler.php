<?php

namespace App\NotificationPublisher\Application\Handler;

use App\NotificationPublisher\Application\Service\NotificationManager;
use App\NotificationPublisher\Domain\Model\Notification;

class SendNotificationHandler
{
    private NotificationManager $notificationManager;

    public function __construct(NotificationManager $notificationManager)
    {
        $this->notificationManager = $notificationManager;
    }

    public function handle(Notification $notification)
    {
        $this->notificationManager->send(
            $notification->getUserId(),
            $notification->getMessage(),
            $notification->getChannel(),
            $notification->getFallbackChannel()
        );
    }
}
