<?php

namespace App\Tests\NotificationPublisher\Application\Service;

use App\NotificationPublisher\Application\Service\NotificationManager;
use App\NotificationPublisher\Domain\Service\NotificationSenderInterface;
use App\NotificationPublisher\Infrastructure\Email\WhatsappSender;
use App\NotificationPublisher\Infrastructure\Email\SMTPSender;
use App\NotificationPublisher\Infrastructure\Push\FirebaseSender;
use App\NotificationPublisher\Infrastructure\Push\PushySender;
use App\NotificationPublisher\Infrastructure\SMS\NexmoSender;
use PHPUnit\Framework\TestCase;

class NotificationManagerTest extends TestCase
{
    private NotificationManager $notificationManager;

    protected function setUp(): void
    {
        $primaryEmailSender = $this->createMock(WhatsappSender::class);
        $secondaryEmailSender = $this->createMock(SMTPSender::class);
        $primarySmsSender = $this->createMock(WhatsappSender::class);
        $primaryPushSender = $this->createMock(PushySender::class);
        $secondaryPushSender = $this->createMock(FirebaseSender::class);

        // Configure the mocks
        $primaryEmailSender->method('send')->willReturn(true); // Primary email sender will succeed
        $secondaryEmailSender->method('send')->willReturn(false); // Secondary email sender will fail
        $primarySmsSender->method('send')->willReturn(false); // Primary SMS sender will fail
        $primaryPushSender->method('send')->willReturn(false); // Primary Push sender will fail
        $secondaryPushSender->method('send')->willReturn(true); // Secondary Push sender will succeed

        $this->notificationManager = new NotificationManager(
            [
                $primaryEmailSender,
                $secondaryEmailSender,
                $primarySmsSender,
                $primaryPushSender,
                $secondaryPushSender
            ],
            [
                'email' => [
                    'secondary' => SMTPSender::class
                ],
                'whatsapp' => [
                    'primary' => WhatsappSender::class,
                ],
                'push' => [
                    'primary' => PushySender::class,
                    'secondary' => FirebaseSender::class
                ]
            ]
        );
    }

    public function testSendNotificationPrimarySuccess()
    {
        $result = $this->notificationManager->send('user1', 'Test message', 'email', 'sms');
        $this->assertEquals([true], $result);
    }

    public function testSendNotificationPrimaryFailureSecondarySuccess()
    {
        $primaryEmailSender = $this->createMock(WhatsappSender::class);
        $secondaryEmailSender = $this->createMock(SMTPSender::class);

        $primaryEmailSender->method('send')->willReturn(false);
        $secondaryEmailSender->method('send')->willReturn(true);

        $this->notificationManager = new NotificationManager(
            [
                $primaryEmailSender,
                $secondaryEmailSender
            ],
            [
                'email' => [
                    'primary' => WhatsappSender::class,
                    'secondary' => SMTPSender::class
                ]
            ]
        );

        $result = $this->notificationManager->send('user1', 'Test message', 'email', 'sms');
        $this->assertEquals([false, true], $result);
    }

    public function testSendNotificationPrimaryAndSecondaryFailureFallbackPrimarySuccess()
    {
        $primaryEmailSender = $this->createMock(WhatsappSender::class);
        $secondaryEmailSender = $this->createMock(SMTPSender::class);
        $primaryPushSender = $this->createMock(PushySender::class);

        $primaryEmailSender->method('send')->willReturn(false);
        $secondaryEmailSender->method('send')->willReturn(false);
        $primaryPushSender->method('send')->willReturn(true);

        $this->notificationManager = new NotificationManager(
            [
                $primaryEmailSender,
                $secondaryEmailSender,
                $primaryPushSender
            ],
            [
                'email' => [
                    'primary' => WhatsappSender::class,
                    'secondary' => SMTPSender::class
                ],
                'push' => [
                    'primary' => PushySender::class,
                    'secondary' => FirebaseSender::class,
                ]
            ]
        );

        $result = $this->notificationManager->send('user1', 'Test message', 'email', 'push');
        $this->assertEquals([false, false, true], $result);
    }
}
