<?php

namespace Src\Management\Auth\Application\Auth;

use Src\Management\Auth\Application\AccessToken\Validation\isTokenValidUseCase;
use Src\Management\Auth\Application\JWT\DecodeUseCase;
use Src\Management\Auth\Domain\Contracts\JwtAutheticationContract;
use Src\Management\Auth\Domain\UserAccessToken;
use Src\Management\Auth\Domain\ValueObjects\AccessTokenValueObject;
use Src\Management\Auth\Domain\ValueObjects\LoginJwt;

final class LoginCheckAuthenticationUseCase
{
    public function __construct(
        private readonly JwtAutheticationContract $jwtAutheticationContract,
        private readonly DecodeUseCase $decodeUseCase,
        private readonly isTokenValidUseCase $isTokenValidUseCase
    ){}
    /**
     * @return bool
     */
    public function __invoke(string $jwt): bool
    {
        $jwtToken = $this->decodeJwt($jwt);
        return $this->checkTokenValid($jwtToken)->entity();
    }
    /**
     * @return array<string,mixed>
     * @param mixed $token
     */
    private function decodeJwt($token): array
    {
        // dd($token);
        $decodeUser = $this->decodeUseCase->__invoke($token);
        return [
            "user_id"=>$decodeUser->id,
            "token"=>$token
        ];
   }
    /**
     * @return void
     * @param array<int,mixed> $userToken
     */
    private function checkTokenValid(array $userToken): UserAccessToken
    {
      return $this->isTokenValidUseCase->__invoke($userToken);
    }
}
