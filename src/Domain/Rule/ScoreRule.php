<?php

declare(strict_types=1);

namespace App\Domain\Rule;

use App\Domain\Entity\Client;
use App\Domain\Entity\Loan;
use App\Domain\Exception\CreditRuleException;

class ScoreRule implements CreditCheckRuleInterface
{
    private const MIN_SCORE = 500;

    public function check(Client $client, Loan $loan): void
    {
        $score = $client->getScore();

        if ($score <= self::MIN_SCORE) {
            throw new CreditRuleException(sprintf('Client credit score must be greater than %d.', self::MIN_SCORE));
        }
    }
}
