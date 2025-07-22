<?php

declare(strict_types=1);

namespace App\Infrastructure\Factory;

use App\Domain\Entity\Client;
use App\Domain\Factory\ClientFactoryInterface;
use App\Domain\Vo\AddressVo;

final class ClientFactory implements ClientFactoryInterface
{
    public function create(
        ?string $firstName = null,
        ?string $lastName = null,
        ?string $middleName = null,
        ?int $age = null,
        ?string $pin = null,
        ?AddressVo $addressVo = null,
        ?string $phone = null,
        ?string $email = null,
        ?int $income = null,
        ?int $score = null,
    ): Client {
        $client = new Client();
        $address = $addressVo->city . ', ' . $addressVo->region;

        $client
            ->setFirstName($firstName)
            ->setLastName($lastName)
            ->setMiddleName($middleName)
            ->setAge($age)
            ->setPin($pin)
            ->setAddress($address)
            ->setPhone($phone)
            ->setIncome($income)
            ->setScore($score)
            ->setEmail($email)
        ;

        return $client;
    }
}
