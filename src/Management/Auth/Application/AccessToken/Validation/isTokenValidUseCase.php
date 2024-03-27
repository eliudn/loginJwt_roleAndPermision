<?php

namespace Src\Management\Auth\Application\AccessToken\Validation;

use Src\Management\Auth\Domain\Contracts\AccessTokenRepositoriesContract;
use Src\Management\Auth\Domain\UserAccessToken;
use Src\Management\Auth\Domain\ValueObjects\AccessTokenValueObject;


class isTokenValidUseCase
{
    public function __construct(
        private readonly AccessTokenRepositoriesContract $accessTokenRepositoriesContract
    )
    {
    }
    /**
     * @param array{token: string, user_id: ?int} $request
     * @return UserAccessToken
     */
    public function __invoke(array $request): UserAccessToken
    {
        return $this->accessTokenRepositoriesContract->isTokenValid(new AccessTokenValueObject($request));
    }
}
