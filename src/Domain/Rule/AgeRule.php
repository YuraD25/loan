<?php

declare(strict_types=1);

namespace App\Domain\Rule;

use App\Domain\Entity\Client;
use App\Domain\Entity\Loan;
use App\Domain\Exception\CreditRuleException;

class AgeRule implements CreditCheckRuleInterface
{
    private const MIN_AGE = 18;
    private const MAX_AGE = 60;

    public function check(Client $client, Loan $loan): void
    {
        $age = $client->getAge();
        if ($age < self::MIN_AGE || $age > self::MAX_AGE) {
            throw new CreditRuleException('Client age must be between ' . self::MIN_AGE . ' and ' . self::MAX_AGE . '.');
        }
    }
}
