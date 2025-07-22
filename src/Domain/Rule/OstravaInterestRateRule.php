<?php

declare(strict_types=1);

namespace App\Domain\Rule;

use App\Domain\Entity\Client;
use App\Domain\Entity\Loan;
use App\Domain\Vo\AddressVo;

class OstravaInterestRateRule
{
    private const RATE_INCREASE = 5;

    public function apply(Client $client, Loan $loan): Loan
    {
        $addressVo = AddressVo::fromString($client->getAddress());

        if (AddressVo::REGION_OSTRAVA === $addressVo->region) {
            $loan->setRate(self::RATE_INCREASE);
        }

        return $loan;
    }
}
