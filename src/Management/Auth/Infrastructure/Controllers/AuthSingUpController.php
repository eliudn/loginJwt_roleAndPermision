<?php

namespace Src\Management\Auth\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Management\Auth\Application\SingUp\SingUpUseCase;
use Src\Management\Auth\Infrastructure\Requests\SingUpRequest;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;


final class AuthSingUpController extends CustomController
{
    use HttpCodesHelper;
    public function __construct(
        private readonly SingUpUseCase $singUpUseCase
    )
    {

    }
    /**
     * @return JsonResponse
     */
    public function __invoke(SingUpRequest $request): JsonResponse
    {

        return $this->jsonResponse(
            $this->ok(),
            false,
            $this->singUpUseCase->__invoke($request->toArray())->entity()
        );

    }
}
