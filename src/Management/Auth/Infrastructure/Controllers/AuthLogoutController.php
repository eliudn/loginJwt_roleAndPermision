<?php

namespace Src\Management\Auth\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Management\Auth\Application\Logout\LogoutUseCase;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;
use Src\Shared\Infrastructure\Middleware\AuthMiddleware;

class AuthLogoutController extends CustomController
{
    use HttpCodesHelper;

    public function __construct(
        private readonly LogoutUseCase $logoutUseCase
    )
    {
        $this->middleware(AuthMiddleware::class);
    }
    /**
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        return $this->jsonResponse(
            $this->ok(),
            false,
            $this->logoutUseCase->__invoke($request->header("Authentication"))->entity()
            // "logout"
        );
    }
}
