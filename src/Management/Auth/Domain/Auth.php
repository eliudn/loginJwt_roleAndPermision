<?php

namespace Src\Management\Auth\Domain;

use Src\Management\Auth\Domain\Exceptions\NotLoginException;
use Src\Management\Auth\Domain\Exceptions\UserSingUpException;
use Src\Shared\Domain\Domain;
use Src\Shared\Domain\Helper\HttpCodesDomainHelper;

final class Auth extends Domain
{
    use HttpCodesDomainHelper;
    private const USER_OR_PASSWORD_INCORRECT = 'USER_OR_PASSWORD_INCORRECT';
    private const USER_ERROR_SINGUP = 'USER_ERROR_SINGUP';
    private const LOGOUT = 'LOGOUT';
    protected function isException(?string $exception): void
    {
        if(!is_null($exception)){
            match ($exception){
                self::USER_OR_PASSWORD_INCORRECT=>throw  new NotLoginException(
                    "email or password incorrect",$this->badRequest()
                ),
                self::USER_ERROR_SINGUP=> throw new UserSingUpException(
                    'Sing up error', $this->badRequest()
                ),
                self::LOGOUT => throw new UserSingUpException(
                    'Logout', $this->notFound()
                ),
            };
        }
    }
    /**
     * @return array<string,mixed>
     */
    public function handler(): array
    {

        return [
                "id"=>$this->entity()["id"],
                "username"=>$this->entity()["username"],
                "name"=> $this->entity()["name"],
                "last_name"=> $this->entity()["last_name"],
                "email"=> $this->entity()["email"]

        ];
    }
}
