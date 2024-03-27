<?php

namespace Src\Management\Auth\Domain\Contracts;

use Src\Management\Auth\Domain\ValueObjects\JwtAuthenticationValueObject;
use Src\Management\Auth\Domain\ValueObjects\LoginJwt;

interface JwtAutheticationContract
{
    public function auth(JwtAuthenticationValueObject $jwtAuthenticationValueObject):string;
    public function check(LoginJwt $loginJwtValueObject):bool;
    public function get(LoginJwt $loginJwtValueObject):mixed;
}
