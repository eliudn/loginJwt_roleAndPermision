<?php

namespace Src\Management\Auth\Application\AccessToken\Invalidate;

use Src\Management\Auth\Domain\Contracts\AccessTokenRepositoriesContract;
use Src\Management\Auth\Domain\UserAccessToken;
use Src\Management\Auth\Domain\ValueObjects\AccessTokenValueObject;

class InvalidateJwtUseCase
{
    public function __construct(
        private readonly AccessTokenRepositoriesContract $accessTokenRepositorieContract
    )
    {
    }
    /**
     * @param array{token: string} $request
     * @return UserAccessToken
     */
    public  function __invoke(array $request): UserAccessToken
    {
        return $this->accessTokenRepositorieContract
            ->invalidate(new AccessTokenValueObject($request));
    }

    private function checkTokenValid($token)
    {
        $accessTokenValueObject =new AccessTokenValueObject($token);
        $userToken = $this->accessTokenRepositorieContract->findByToken($accessTokenValueObject);

        if(count($userToken) == 0)
        {
            return new UserAccessToken(null, 'ERROR_INATIVATE_ACCESS_TOKEN');
        }
        $check = $accessTokenValueObject->isTokenOwnerValid($userToken["user_id"]);
        if(!$check){
        }
    }
}
