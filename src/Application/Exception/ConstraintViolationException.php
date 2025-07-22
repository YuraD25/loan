<?php

declare(strict_types=1);

namespace App\Application\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ConstraintViolationException extends ApiException
{
    private ConstraintViolationListInterface $violationList;

    public function __construct(ConstraintViolationListInterface $violationList, string $message = 'Validation error')
    {
        parent::__construct($message, Response::HTTP_BAD_REQUEST);

        $this->violationList = $violationList;
    }

    public function getStatusCode(): int
    {
        return $this->code;
    }

    public function getViolationList(): ConstraintViolationListInterface
    {
        return $this->violationList;
    }

    public function getHeaders(): array
    {
        return [];
    }
}
