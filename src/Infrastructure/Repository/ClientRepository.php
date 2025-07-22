<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Client;
use App\Domain\Repository\ClientRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ClientRepository extends ServiceEntityRepository implements ClientRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    public function getById(int $id): ?Client
    {
        return $this->findOneBy(['id' => $id]) ?? null;
    }

    public function save(Client $client): void
    {
        $this->getEntityManager()->persist($client);
        $this->getEntityManager()->flush();
    }
}
