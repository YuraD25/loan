<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use Symfony\Component\HttpFoundation\Response;

class DomainException extends \RuntimeException
{
    public function __construct(string $message, ?int $code = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        parent::__construct($message, $code);
    }
}
