<?php

namespace Src\Management\Auth\Infrastructure\Repositories\Eloquent;

use Carbon\Carbon;
use Src\Management\Auth\Domain\Contracts\AccessTokenRepositoriesContract;
use Src\Management\Auth\Domain\UserAccessToken;
use Src\Management\Auth\Domain\ValueObjects\AccessTokenValueObject;
use Src\Management\Auth\Infrastructure\Repositories\Eloquent\UserAccessToken as Model;

class AccessTonkenRepositories implements AccessTokenRepositoriesContract
{
    public function __construct(
        private Model $model
    )
    {
    }
    public function register(AccessTokenValueObject $accessTokenValueObject): UserAccessToken
    {
        if ($this->checkExistToken($accessTokenValueObject->value()["token"]))
        {
            return new UserAccessToken(null, "ERROR_REGISTER_ACCESS_TOKEN");}

        $userAT = $this->model->create($accessTokenValueObject->value());
        if(!$userAT){
            dd("incorrecto");
            return new UserAccessToken(null, "ERROR_REGISTER_ACCESS_TOKEN");
        }
        return new UserAccessToken(true);
   }

    public function invalidate(AccessTokenValueObject $accessTokenValueObject): UserAccessToken
    {
        /* $userId = $this
            ->accessTokenByToken(
                $accessTokenValueObject
                    ->value()["token"]
            );
        $check = $accessTokenValueObject->isTokenOwnerValid($userId);
        if (!$check){
            return new UserAccessToken(null, 'ERROR_INATIVATE_ACCESS_TOKEN');
        } */
        $userAT = $this->model->where('token',$accessTokenValueObject->value()["token"])
            ->first();
        $userAT->invalid_token_at = Carbon::now();
        $userAT->save();

        return new UserAccessToken(true);

    }
    public function  isTokenValid(AccessTokenValueObject $accessTokenValueObject): UserAccessToken
    {
        // dd($accessTokenValueObject->value());
        $userId = $this
            ->accessTokenByToken(
                $accessTokenValueObject
                    ->value()["token"]
            );
        $check = $accessTokenValueObject->isTokenOwnerValid($userId);
        if (!$check){
            return new UserAccessToken(false);
            // return new UserAccessToken(null, 'ERROR_ACCESS_TOKEN');
        }
        $checkToken = $this->checkExistToken($accessTokenValueObject->value()["token"]);

        return new UserAccessToken($checkToken);
    }
    /**
     * @param mixed $token
     * return bool
     */
    private function checkExistToken($token):bool
    {
        $userAT = $this->model->where("token", $token)->first();
        return $userAT ? true: false;
    }
    /**
     * @param mixed $token
     * return array
     */
    private function accessTokenByToken($token):array
    {
        $userAT = $this->model
            ->where("token", $token)
            ->whereNull("invalid_token_at")
            ->first();
        return  $userAT ? $userAT->toArray():[];
    }

    public function findByToken(AccessTokenValueObject $accessTokenValueObject): UserAccessToken
    {
        return new UserAccessToken($accessTokenValueObject->value());
    }
}
