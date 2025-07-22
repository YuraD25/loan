<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Credit\Rule;

use App\Domain\Entity\Client;
use App\Domain\Exception\CreditRuleException;
use App\Domain\Rule\AgeRule;
use App\Domain\Entity\Loan;
use PHPUnit\Framework\TestCase;

class AgeRuleTest extends TestCase
{
    public function testCheckThrowsExceptionForClientYoungerThan18(): void
    {
        $this->expectException(CreditRuleException::class);
        $this->expectExceptionMessage('Client age must be between 18 and 60.');

        $rule = new AgeRule();
        $client = $this->createMock(Client::class);
        $loan = $this->createMock(Loan::class);

        $client->method('getAge')->willReturn(17);

        $rule->check($client, $loan);
    }

    public function testCheckThrowsExceptionForClientOlderThan60(): void
    {
        $this->expectException(CreditRuleException::class);

        $rule = new AgeRule();
        $client = $this->createMock(Client::class);
        $loan = $this->createMock(Loan::class);
        $client->method('getAge')->willReturn(61);

        $rule->check($client, $loan);
    }

    public function testCheckDoesNotThrowExceptionForValidAge(): void
    {
        $rule = new AgeRule();
        $client = $this->createMock(Client::class);
        $loan = $this->createMock(Loan::class);
        $client->method('getAge')->willReturn(35);

        $rule->check($client, $loan);

        $this->assertTrue(true);
    }
}
