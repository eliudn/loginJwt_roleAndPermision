<?php

namespace Src\Management\Auth\Infrastructure\Controllers;

use Illuminate\Http\Request;
use Src\Management\Auth\Application\AccessToken\Invalidate\InvalidateJwtUseCase;
use Src\Management\Auth\Application\AccessToken\Register\RegisterJwtUseCase;
use Src\Management\Auth\Application\AccessToken\Validation\isTokenValidUseCase;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;

class AuthPruebasController extends CustomController
{
    use HttpCodesHelper;
    public  function __construct(
        private readonly RegisterJwtUseCase $registerJwtUseCase,
        private readonly InvalidateJwtUseCase $invalidateJwtUseCase,
        private readonly isTokenValidUseCase $isTokenValidUseCase
    )
    {
    }
    public function __invoke(Request $request): mixed
    {
        return $this->jsonResponse($this->ok(),
            false,
            $this->isTokenValidUseCase->__invoke($request->toArray())->entity()
        );
    }
}
