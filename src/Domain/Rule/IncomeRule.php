<?php

declare(strict_types=1);

namespace App\Domain\Rule;

use App\Domain\Entity\Client;
use App\Domain\Entity\Loan;
use App\Domain\Exception\CreditRuleException;

final class IncomeRule implements CreditCheckRuleInterface
{
    private const MIN_INCOME_DOLLARS = 1000;

    public function check(Client $client, Loan $loan): void
    {
        $minIncomeInCents = self::MIN_INCOME_DOLLARS;

        if ($client->getIncome() < $minIncomeInCents) {
            $message = sprintf(
                'Client monthly income must be at least $%d.',
                self::MIN_INCOME_DOLLARS
            );
            throw new CreditRuleException($message);
        }
    }
}
