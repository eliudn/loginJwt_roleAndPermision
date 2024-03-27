<?php

namespace Src\Shared\Domain\Trait;

trait EnvValuesJwt
{
    public function jwtKey():string
    {
        return env('JWT_KEY');
    }
    public function jwtEncrypt():string
    {
        return env('JWT_ENCRYPT');
    }
}
