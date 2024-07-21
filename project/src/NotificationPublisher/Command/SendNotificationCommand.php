<?php

namespace App\NotificationPublisher\Command;

use App\NotificationPublisher\Application\Handler\SendNotificationHandler;
use App\NotificationPublisher\Domain\Model\Notification;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:send-notification',
    description: 'Tries to send a notification via a specific channel and falls back to a second channel',
)]

class SendNotificationCommand extends Command
{
    private SendNotificationHandler $handler;

    public function __construct(SendNotificationHandler $handler)
    {
        $this->handler = $handler;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Send a notification')
            ->addArgument('userId', InputArgument::REQUIRED, 'The ID of the user')
            ->addArgument('message', InputArgument::REQUIRED, 'The notification message')
            ->addArgument('channel', InputArgument::REQUIRED, 'The notification channel (email, sms or push)')
            ->addArgument('fallbackChannel', InputArgument::REQUIRED, 'The fallback notification channel');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $userId = $input->getArgument('userId');
        $message = $input->getArgument('message');
        $channel = $input->getArgument('channel');
        $fallbackChannel = $input->getArgument('fallbackChannel');

        $notification = new Notification($userId, $message, $channel, $fallbackChannel);
        $this->handler->handle($notification);

        return Command::SUCCESS;
    }
}
