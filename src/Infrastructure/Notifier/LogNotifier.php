<?php

declare(strict_types=1);

namespace App\Infrastructure\Notifier;

use App\Application\Notifier\NotifierInterface;
use App\Domain\Entity\Client;
use Psr\Log\LoggerInterface;

class LogNotifier implements NotifierInterface
{
    public function __construct(private readonly LoggerInterface $logger)
    {
    }

    public function notify(Client $client, string $message): void
    {
        $this->logger->info(
            "Уведомление клиенту {$client->getFirstName()}: $message"
        );
    }
}
