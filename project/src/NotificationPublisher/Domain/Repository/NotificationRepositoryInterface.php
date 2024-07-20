<?php

namespace App\NotificationPublisher\Domain\Repository;

use App\NotificationPublisher\Domain\Model\Notification;

interface NotificationRepositoryInterface
{
    public function save(Notification $notification): void;
}
