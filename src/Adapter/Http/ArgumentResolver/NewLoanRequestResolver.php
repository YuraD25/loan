<?php

declare(strict_types=1);

namespace App\Adapter\Http\ArgumentResolver;

use App\Application\Dto\LoanDto;
use App\Application\Exception\ConstraintViolationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;

readonly class NewLoanRequestResolver implements ValueResolverInterface
{
    public function __construct(private ValidatorInterface $validator)
    {
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $argumentType = $argument->getType();

        if (is_null($argumentType)) {
            return [];
        }

        if (!class_exists($argumentType) || LoanDto::class !== $argumentType) {
            return [];
        }

        $requestDto = LoanDto::fromArray($request->toArray());

        $errors = $this->validator->validate($requestDto);

        if ($errors->count() > 0) {
            throw new ConstraintViolationException($errors);
        }

        yield $requestDto;
    }
}
