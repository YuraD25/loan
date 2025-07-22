<?php

declare(strict_types=1);

namespace App\Infrastructure\Factory;

use App\Domain\Entity\Client;
use App\Domain\Entity\Loan;
use App\Domain\Factory\LoanFactoryInterface;

final class LoanFactory implements LoanFactoryInterface
{
    public function create(
        string $name,
        Client $client,
        int $amount,
        int $rate,
        int $term,
    ): Loan {
        $loan = new Loan();

        $loan
            ->setName($name)
            ->setAmount($amount)
            ->setRate($rate)
            ->setTerm($term)
            ->setClient($client);

        return $loan;
    }
}
