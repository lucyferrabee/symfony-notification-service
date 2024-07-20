<?php

namespace App\NotificationPublisher\Command;

use App\NotificationPublisher\Application\Handler\SendNotificationHandler;
use App\NotificationPublisher\Domain\Model\Notification;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendNotificationCommand extends Command
{
    protected static $defaultName = 'app:send-notification';

    private SendNotificationHandler $sendNotificationHandler;

    public function __construct(SendNotificationHandler $sendNotificationHandler)
    {
        parent::__construct();
        $this->sendNotificationHandler = $sendNotificationHandler;
    }

    protected function configure()
    {
        $this
            ->setDescription('Send a notification to a user')
            ->addArgument('userId', InputArgument::REQUIRED, 'The ID of the user')
            ->addArgument('message', InputArgument::REQUIRED, 'The message to send')
            ->addArgument('channel', InputArgument::REQUIRED, 'The notification channel (email or sms)');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $userId = $input->getArgument('userId');
        $message = $input->getArgument('message');
        $channel = $input->getArgument('channel');

        $notification = new Notification($userId, $message, $channel);
        $this->sendNotificationHandler->handle($notification);

        $output->writeln('Notification sent successfully.');

        return Command::SUCCESS;
    }

    protected function getUserId(): int
    {
        return 1;
    }

    protected function getMessage(): string
    {
        return 'This is your notification';
    }

    protected function getChannel(): string
    {
        return 'email';
    }
}
