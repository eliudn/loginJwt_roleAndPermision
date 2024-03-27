<?php

namespace Src\Shared\Infrastructure\Middleware;

use Closure;
use Illuminate\Http\Request;
use Src\Management\Auth\Application\Auth\CheckTokenAutheticationUseCase;
use Src\Management\Auth\Application\Auth\LoginCheckAuthenticationUseCase;
use Src\Shared\Infrastructure\Exceptions\AuthException;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;

final class AuthMiddleware
{
    const NEW_CONSTANT = 'Invalid token or Invalid user or expired token';
    use HttpCodesHelper;
    public function __construct(
        private readonly CheckTokenAutheticationUseCase $checkTokenAutheticationUseCase,
        private readonly LoginCheckAuthenticationUseCase $loginCheckAuthenticationUseCase
    ){}
    /**
     * @param Closure(): void $next
     */
    public function handle(Request $request, Closure $next):mixed
    {

        if(empty($request->header('Authentication')))
        {
            throw new AuthException("Not JWT authentication", $this->badRequest());
        }
        $authetication = $request->header('Authentication');

        $checkToken = $this->checkTokenAutheticationUseCase->__invoke($authetication);
        if (!$checkToken)
        {

            throw new AuthException(self::NEW_CONSTANT, $this->badRequest());
        }
        $check = $this->loginCheckAuthenticationUseCase->__invoke($authetication);

        if (!$check )
        {

            throw new AuthException(self::NEW_CONSTANT, $this->badRequest());
        }
        return $next($request);
    }
}
