<?php

declare(strict_types=1);

namespace App\Adapter\Http\ArgumentResolver;

use App\Application\Dto\ClientDto;
use App\Application\Exception\ConstraintViolationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;

readonly class NewClientRequestResolver implements ValueResolverInterface
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

        if (!class_exists($argumentType) || ClientDto::class !== $argumentType) {
            return [];
        }

        $requestDto = ClientDto::fromArray($request->toArray());

        $errors = $this->validator->validate($requestDto);

        if ($errors->count() > 0) {
            throw new ConstraintViolationException($errors);
        }

        yield $requestDto;
    }
}
