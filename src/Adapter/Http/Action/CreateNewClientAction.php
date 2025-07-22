<?php

declare(strict_types=1);

namespace App\Adapter\Http\Action;

use App\Adapter\Http\ArgumentResolver\NewClientRequestResolver;
use App\Application\Dto\ClientDto;
use App\Application\UseCase\CreateNewClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\ValueResolver;
use Symfony\Component\Routing\Attribute\Route;
use Throwable;

class CreateNewClientAction extends AbstractController
{
    #[Route(path: '/create-new-client', name: 'create_new_client', methods: Request::METHOD_POST)]
    public function __invoke(
        #[ValueResolver(NewClientRequestResolver::class)] ClientDto $clientDto,
        CreateNewClient $useCase,
    ): JsonResponse {
        try {
            $useCase->handle($clientDto);

            return new JsonResponse(
                [
                    'status' => 'success',
                    'message' => 'Клиент успешно создан'
                ],
                Response::HTTP_OK
            );
        } catch (Throwable $e) {
            return new JsonResponse(
                ['error' => $e->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
