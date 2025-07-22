<?php

declare(strict_types=1);

namespace App\Adapter\Http\Action;

use App\Adapter\Http\ArgumentResolver\NewLoanRequestResolver;
use App\Application\Dto\LoanDto;
use App\Application\UseCase\CheckIssueLoan;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\ValueResolver;
use Symfony\Component\Routing\Attribute\Route;
use Throwable;

class CheckIssueLoanAction extends AbstractController
{
    #[Route(path: '/check-new-loan', name: 'check_new_loan', methods: Request::METHOD_POST)]
    public function __invoke(
        #[ValueResolver(NewLoanRequestResolver::class)] LoanDto $loanDto,
        CheckIssueLoan $useCase,
    ): JsonResponse {
        try {
            $useCase->handle($loanDto);

            return new JsonResponse(
                [
                    'status' => 'success',
                    'message' => 'Кредит может быть одобрен'
                ],
                Response::HTTP_OK
            );
        } catch (Throwable $e) {
            return new JsonResponse(
                [
                    'status' => 'error',
                    'error' => $e->getMessage(),
                    'message' => 'Кредит не может быть одобрен',
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }
}
