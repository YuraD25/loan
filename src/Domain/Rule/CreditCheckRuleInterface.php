<?php

declare(strict_types=1);

namespace App\Domain\Rule;

use App\Domain\Entity\Client;
use App\Domain\Entity\Loan;
use App\Domain\Exception\CreditRuleException;

interface CreditCheckRuleInterface
{
    /**
     * @throws CreditRuleException если правило не выполнено
     */
    public function check(Client $client, Loan $loan): void;
}
