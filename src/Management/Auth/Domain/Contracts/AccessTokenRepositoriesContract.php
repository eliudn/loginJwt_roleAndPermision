<?php

namespace Src\Management\Auth\Domain\Contracts;

use Src\Management\Auth\Domain\UserAccessToken;
use Src\Management\Auth\Domain\ValueObjects\AccessTokenValueObject;

interface AccessTokenRepositoriesContract
{
    public function register(AccessTokenValueObject $accessTokenValueObject):UserAccessToken;

    public function invalidate(AccessTokenValueObject $accessTokenValueObject):UserAccessToken;

    public function  isTokenValid(AccessTokenValueObject $accessTokenValueObject): UserAccessToken;

    public function  findByToken(AccessTokenValueObject $accessTokenValueObject): UserAccessToken;
}
