<?php

declare(strict_types=1);

namespace App\Domain\Rule;

use App\Domain\Entity\Client;
use App\Domain\Entity\Loan;
use App\Domain\Exception\CreditRuleException;
use App\Domain\Vo\AddressVo;

final class RegionRule implements CreditCheckRuleInterface
{
    public function check(Client $client, Loan $loan): void
    {
        $addressVo = AddressVo::fromString($client->getAddress());

        if (!in_array($addressVo->region, AddressVo::ALLOWED_REGIONS, true)) {
            $message = sprintf(
                'Credit applications are only accepted from the following regions: %s.',
                implode(', ', AddressVo::ALLOWED_REGIONS)
            );

            throw new CreditRuleException($message);
        }
    }
}
