<?php

declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\Dto\ClientDto;
use App\Domain\Factory\ClientFactoryInterface;
use App\Domain\Repository\ClientRepositoryInterface;
use App\Domain\Vo\AddressVo;

readonly class CreateNewClient
{
    public function __construct(
        private ClientRepositoryInterface $clientRepository,
        private ClientFactoryInterface $clientFactory,
    ) {
    }

    public function handle(ClientDto $clientDto): void
    {
        $address = AddressVo::fromString($clientDto->city . ', ' . $clientDto->region);

        $client = $this->clientFactory->create(
            $clientDto->firstName,
            $clientDto->lastName,
            $clientDto->middleName,
            $clientDto->age,
            $clientDto->pin,
            $address,
            $clientDto->phone,
            $clientDto->email,
            $clientDto->income,
            $clientDto->score
        );
        $this->clientRepository->save($client);
    }
}
