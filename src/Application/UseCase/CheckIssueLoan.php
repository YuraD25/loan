<?php

declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\Dto\LoanDto;
use App\Application\Notifier\NotifierInterface;
use App\Domain\Exception\CreditRuleException;
use App\Domain\Factory\LoanFactoryInterface;
use App\Domain\Repository\ClientRepositoryInterface;
use App\Domain\Rule\CreditCheckRuleInterface;
use App\Domain\Rule\OstravaInterestRateRule;
use Psr\Log\LoggerInterface;

readonly class CheckIssueLoan
{
    /** @var CreditCheckRuleInterface[] */
    private iterable $rules;

    public function __construct(
        private ClientRepositoryInterface $clientRepository,
        private LoanFactoryInterface $loanFactory,
        private OstravaInterestRateRule $ostravaRule,
        private NotifierInterface $notifier,
        private LoggerInterface $logger,
        iterable $rules,
    ) {
        $this->rules = $rules;
    }

    /**
     * @throws \Exception
     */
    public function handle(LoanDto $loanDto): void
    {
        try {
            $client = $this->clientRepository->getById($loanDto->clientId);

            if (null === $client) {
                throw new \Exception("Client $loanDto->clientId not found");
            }

            $startDate = new \DateTimeImmutable($loanDto->startDate);
            $endDate = new \DateTimeImmutable($loanDto->endDate);
            $term = $startDate->diff($endDate)->days;

            $loan = $this->loanFactory->create(
                $loanDto->name,
                $client,
                $loanDto->amount,
                $loanDto->rate,
                $term
            );

            foreach ($this->rules as $rule) {
                $rule->check($client, $loan);
            }

            $loan = $this->ostravaRule->apply($client, $loan);
        } catch (CreditRuleException $exception) {
            $this->logger->error($exception->getMessage());
            if (isset($client)) {
                $this->notifier->notify($client, 'Кредит не может быть одобрен.' . $exception->getMessage());
            }

            throw $exception;
        }
    }
}
