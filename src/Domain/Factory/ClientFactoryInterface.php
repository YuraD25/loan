<?php

declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Entity\Client;
use App\Domain\Vo\AddressVo;

interface ClientFactoryInterface
{
    public function create(
        ?string $firstName = null,
        ?string $lastName = null,
        ?string $middleName = null,
        ?int $age = null,
        ?string $pin = null,
        ?AddressVo $addressVo = null,
        ?string $phone = null,
        ?string $email = null,
        ?int $income = null,
        ?int $score = null,
    ): Client;
}
