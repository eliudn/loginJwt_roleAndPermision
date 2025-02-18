<?php

namespace Src\Shared\Infrastructure\Middleware;

use Closure;
use Illuminate\Http\Request;
use Src\Shared\Infrastructure\Exceptions\ApiAuthException;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;

final class ApiMiddleware
{
    use HttpCodesHelper;
    /**
     * @param Closure(): void $next
     */
    public function handle( Request $request, Closure $next):mixed
    {
        if(empty($request->header('Authorization')))
        {
            throw new ApiAuthException(
                "Not auth authorization is empty",
                $this->badRequest()
            );
        }
        if(env("API_KEY")!= $request->header('Authorization'))
        {

            throw new ApiAuthException(
                "No auth authorization is failed",
                $this->unauthorized()
            );
        }
        return $next($request);
    }
}
