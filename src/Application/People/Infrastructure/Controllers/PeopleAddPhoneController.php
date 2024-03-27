<?php

namespace Src\Application\People\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Application\People\Application\Create\AddPhoneUseCase;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;

final class PeopleAddPhoneController extends CustomController
{
    use HttpCodesHelper;
    public function __construct(
        private readonly AddPhoneUseCase $addPhoneUseCase
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
            $this->addPhoneUseCase->__invoke($request->toArray())->entity()
        );
    }
}
