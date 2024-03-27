<?php

namespace Src\Management\Auth\Domain\Contracts;

use Src\Management\Auth\Domain\Auth;
use Src\Management\Auth\Domain\ValueObjects\AuthValueObject;
use Src\Management\Auth\Domain\ValueObjects\LoginValueObject;
use Src\Management\Auth\Domain\ValueObjects\SingUpValueObject;

interface AuthRepositoryContract
{
    public function login(LoginValueObject $loginValueObject):Auth;
    public function logout(AuthValueObject $authValueObject):Auth;
    public function singUp(SingUpValueObject $singUpValueObject):Auth;
}
