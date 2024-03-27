<?php

namespace Src\Management\Auth\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Management\Auth\Application\Login\AuthLoginUseCase;
use Src\Management\Auth\Infrastructure\Requests\LoginRequest;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;

final class AuthLoginController extends CustomController
{
    use HttpCodesHelper;
    public function __construct(
        private readonly AuthLoginUseCase $authLoginUseCase
    )
    {

    }
    /**
     * @return JsonResponse
     */
    public function __invoke(
        LoginRequest $request
    ): JsonResponse
    {
        return $this->jsonResponse(
            $this->ok(),
            false,
            $this->authLoginUseCase->__invoke($request->toArray())->entity()
        );
    }
}
