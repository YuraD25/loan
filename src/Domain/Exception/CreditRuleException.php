<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use Symfony\Component\HttpFoundation\Response;

class CreditRuleException extends DomainException
{
    public function __construct(string $message, ?int $code = Response::HTTP_UNPROCESSABLE_ENTITY)
    {
        parent::__construct($message, $code);
    }
}
