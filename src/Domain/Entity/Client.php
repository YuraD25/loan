<?php

declare(strict_types=1);

namespace App\Domain\Entity;

class Client
{
    public function __construct(
        private ?int $id = null,
        private ?string $firstName = null,
        private ?string $lastName = null,
        private ?string $middleName = null,
        private ?int $income = null,
        private ?int $age = null,
        private ?string $pin = null,
        private ?string $address = null,
        private ?int $score = null,
        private ?string $email = null,
        private ?string $phone = null,
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): Client
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): Client
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    public function setMiddleName(?string $middleName): Client
    {
        $this->middleName = $middleName;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): Client
    {
        $this->age = $age;

        return $this;
    }

    public function getIncome(): int
    {
        return $this->income;
    }

    public function setIncome(?int $age): Client
    {
        $this->income = $age;

        return $this;
    }

    public function getPin(): ?string
    {
        return $this->pin;
    }

    public function setPin(?string $pin): Client
    {
        $this->pin = $pin;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): Client
    {
        $this->address = $address;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(?int $score): Client
    {
        $this->score = $score;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): Client
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): Client
    {
        $this->phone = $phone;

        return $this;
    }
}
