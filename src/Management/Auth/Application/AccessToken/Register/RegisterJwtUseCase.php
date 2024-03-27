<?php

namespace Src\Management\Auth\Application\AccessToken\Register;

use Src\Management\Auth\Domain\Contracts\AccessTokenRepositoriesContract;
use Src\Management\Auth\Domain\UserAccessToken;
use Src\Management\Auth\Domain\ValueObjects\AccessTokenValueObject;

class RegisterJwtUseCase
{
    public function __construct(
        private readonly AccessTokenRepositoriesContract $accessTokenRepositorieContract
    )
    {
    }
    /**
     * @param array<int,mixed> $request
     * @return UserAccessToken
     */
    public  function __invoke(array $request): UserAccessToken
    {
        // dd("use case");
        $accesstoken = $this->accessTokenRepositorieContract->register(new AccessTokenValueObject($request));
        // dd($accesstoken->entity());
        return  $accesstoken;

    }
}
