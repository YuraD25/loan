<?php

declare(strict_types=1);

namespace App\Domain\Entity;

class Loan
{
    public function __construct(
        private ?int $id = null,
        private ?Client $client = null,
        private ?string $name = null,
        private ?int $term = null,
        private ?int $amount = null,
        private ?int $rate = null,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function setClient(Client $client): Loan
    {
        $this->client = $client;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Loan
    {
        $this->name = $name;

        return $this;
    }

    public function getTerm(): int
    {
        return $this->term;
    }

    public function setTerm(int $term): Loan
    {
        $this->term = $term;

        return $this;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): Loan
    {
        $this->amount = $amount;

        return $this;
    }

    public function getRate(): int
    {
        return $this->rate;
    }

    public function setRate(int $rate): Loan
    {
        $this->rate = $rate;

        return $this;
    }
}
