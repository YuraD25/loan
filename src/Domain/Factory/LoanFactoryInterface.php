<?php

declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Entity\Client;
use App\Domain\Entity\Loan;

interface LoanFactoryInterface
{
    public function create(
        string $name,
        Client $client,
        int $amount,
        int $rate,
        int $term,
    ): Loan;
}
