<?php

declare(strict_types=1);

namespace App\Application\Dto;

class LoanDto
{
    public function __construct(
        public ?int $clientId = null,
        public ?string $name = null,
        public ?int $amount = null,
        public ?int $rate = null,
        public ?string $startDate = null,
        public ?string $endDate = null,
    ) {
    }

    public static function fromArray(array $requestData): LoanDto
    {
        return new self(
            $requestData['clientId'] ?? null,
            $requestData['name'] ?? null,
            $requestData['amount'] ?? null,
            $requestData['rate'] ? (int) $requestData['rate'] : null,
            $requestData['start_date'] ?? null,
            $requestData['end_date'] ?? null
        );
    }
}
