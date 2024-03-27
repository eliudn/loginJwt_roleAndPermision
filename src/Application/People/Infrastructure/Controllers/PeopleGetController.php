<?php

namespace Src\Application\People\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Application\People\Application\Get\PeopleGetAllUseCase;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;

final class PeopleGetController extends CustomController
{
    use HttpCodesHelper;

    public function __construct(
        private readonly PeopleGetAllUseCase $peopleGetAllUseCase
    )
    {

    }
    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        return $this->jsonResponse(
            $this->created(),
            false,
            $this->peopleGetAllUseCase->__invoke()->entity()
        );
    }
}
