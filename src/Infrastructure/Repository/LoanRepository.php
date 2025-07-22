<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Loan;
use App\Domain\Repository\LoanRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class LoanRepository extends ServiceEntityRepository implements LoanRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Loan::class);
    }

    public function save(Loan $loan): void
    {
        $this->getEntityManager()->persist($loan);
        $this->getEntityManager()->flush();
    }
}
