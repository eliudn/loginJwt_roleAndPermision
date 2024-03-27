<?php

namespace Src\Management\Auth\Infrastructure\Repositories\FirebaseJwt;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Src\Management\Auth\Domain\Contracts\JwtAutheticationContract;
use Src\Management\Auth\Domain\ValueObjects\JwtAuthenticationValueObject;
use Src\Management\Auth\Domain\ValueObjects\LoginJwt;

final class JwtAuthentication implements  JwtAutheticationContract
{
    private JWT $jwt;
    public function __construct()
    {
        $this->jwt = new JWT();
    }
    public function auth(
        JwtAuthenticationValueObject $jwtAuthenticationValueObject
    ): string
    {
        return $this->jwt::encode(
            $jwtAuthenticationValueObject->handler(),
            $jwtAuthenticationValueObject->jwtKey(),
            $jwtAuthenticationValueObject->jwtEncrypt()
        );
    }

    public function check(LoginJwt $loginJwtValueObject): bool
    {
        try {
            $decode = $this->jwt::decode(
                $loginJwtValueObject->value(),
                new Key(
                    $loginJwtValueObject->jwtKey(),
                    $loginJwtValueObject->jwtEncrypt()
                )
            );
            if(time() >$decode->exp)
            {
                return false;
            }
        }catch(Exception){
            return false;
        }
        return true;
    }

    public function get(LoginJwt $loginJwtValueObject): mixed
    {
        // dd($loginJwtValueObject->value());
            return $this->jwt::decode(
                        $loginJwtValueObject->value(),
                        new Key(
                            $loginJwtValueObject->jwtKey(),
                            $loginJwtValueObject->jwtEncrypt()
                        )
                    )->data;
    }
}
