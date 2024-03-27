<?php

namespace Src\Application\People\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Application\People\Application\Create\AddEmailUseCase;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;

final class PeopleAddEmailController extends CustomController
{
    use HttpCodesHelper;
    public function __construct(
        private readonly AddEmailUseCase $addEmailUseCase
    )
    {

    }
    /**
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {

        return $this->jsonResponse(
            $this->ok(),
            false,
            $this->addEmailUseCase->__invoke($request->toArray())->entity()
        );
    }
}
