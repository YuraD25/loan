<?php

declare(strict_types=1);

namespace App\Application\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ApiException extends \RuntimeException implements HttpExceptionInterface
{
    public function __construct(string $message, ?int $code = null)
    {
        parent::__construct($message);

        $this->message = $message;
        $this->code = $code;
    }

    public function getHeaders(): array
    {
        return [];
    }

    public function getStatusCode(): int
    {
        return Response::HTTP_INTERNAL_SERVER_ERROR;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }
}
