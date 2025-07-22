<?php

declare(strict_types=1);

namespace App\Domain\Rule;

use App\Domain\Entity\Client;
use App\Domain\Entity\Loan;
use App\Domain\Exception\CreditRuleException;
use App\Domain\Vo\AddressVo;

class PragueRandomDeclineRule implements CreditCheckRuleInterface
{
    public function check(Client $client, Loan $loan): void
    {
        $addressVo = AddressVo::fromString($client->getAddress());

        if (AddressVo::REGION_PRAGUE === $addressVo->region) {
            if (0 === random_int(0, 1)) {
                throw new CreditRuleException('Application was randomly declined for Prague region.');
            }
        }
    }
}
