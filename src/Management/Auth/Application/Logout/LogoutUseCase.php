<?php

namespace Src\Management\Auth\Application\Logout;

use Src\Management\Auth\Application\AccessToken\Invalidate\InvalidateJwtUseCase;
use Src\Management\Auth\Application\JWT\DecodeUseCase;
use Src\Management\Auth\Domain\Auth;
use Src\Management\Auth\Domain\UserAccessToken;

class LogoutUseCase
{
    public function __construct(
        private readonly InvalidateJwtUseCase $invalidateJwtUseCase,
        private readonly DecodeUseCase $decodeUseCase
    )
    {
    }

    public function __invoke(string $request): Auth
    {
        try{

            $check = $this->invalidateToken($request)->entity();
            if($check)
            {
                return new Auth("Se ha cerrado session correctamente");
            }
            else{
                return new Auth(null, "LOGOUT");
            }
        }catch(\Exception $e){
            $this->invalidateToken($request);
            return new Auth("Se ha cerrado session correctamente");
        }

    }

    /**
     * @return UserAccessToken
     * @param mixed $token
     */
    private function invalidateToken($token): UserAccessToken
    {
        return $this->invalidateJwtUseCase->__invoke(["token"=>$token]);
    }
}
