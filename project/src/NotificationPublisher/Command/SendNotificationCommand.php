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

        $output->writeln('Notification sent.');

        return Command::SUCCESS;
    }
}
