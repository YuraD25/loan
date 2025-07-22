<?php

declare(strict_types=1);

namespace App\Application\Dto;

class ClientDto
{
    public function __construct(
        public ?string $firstName = null,
        public ?string $lastName = null,
        public ?string $middleName = null,
        public ?string $region = null,
        public ?string $city = null,
        public ?int $age = null,
        public ?int $income = null,
        public ?int $score = null,
        public ?string $pin = null,
        public ?string $phone = null,
        public ?string $email = null,
    ) {
    }

    public static function fromArray(array $requestData): ClientDto
    {
        return new self(
            $requestData['firstName'] ?? null,
            $requestData['lastName'] ?? null,
            $requestData['middleName'] ?? null,
            $requestData['region'] ?? null,
            $requestData['city'] ?? null,
            $requestData['age'] ?? null,
            $requestData['income'] ?? null,
            $requestData['score'] ?? null,
            $requestData['pin'] ?? null,
            $requestData['phone'] ?? null,
            $requestData['email'] ?? null
        );
    }
}
