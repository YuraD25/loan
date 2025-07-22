<?php

declare(strict_types=1);

namespace App\Application\Notifier;

use App\Domain\Entity\Client;

interface NotifierInterface
{
    public function notify(Client $client, string $message): void;
}
