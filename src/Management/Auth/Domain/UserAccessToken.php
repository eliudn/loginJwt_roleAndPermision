<?php

namespace Src\Management\Auth\Domain;

use Src\Management\Auth\Domain\Exceptions\AccessTokenException;
use Src\Shared\Domain\Domain;
use Src\Shared\Domain\Helper\HttpCodesDomainHelper;

class UserAccessToken extends Domain
{
    use HttpCodesDomainHelper;

    private const ERROR_REGISTER_ACCESS_TOKEN = 'ERROR_REGISTER_ACCESS_TOKEN';
    private const ERROR_INATIVATE_ACCESS_TOKEN = 'ERROR_INATIVATE_ACCESS_TOKEN';
    private const ERROR_ACCESS_TOKEN = 'ERROR_ACCESS_TOKEN';

    protected function isException(?string $exception): void
    {

        if(!is_null($exception))
        {
            match ($exception)
            {
                self::ERROR_REGISTER_ACCESS_TOKEN => throw new AccessTokenException("No se puedo registar el token",$this->badRequest()),
                self::ERROR_INATIVATE_ACCESS_TOKEN => throw new AccessTokenException("Acceso no autorizado",$this->unauthorized()),
                self::ERROR_ACCESS_TOKEN => throw new AccessTokenException("Acceso no autorizado",$this->unauthorized())
            };
        }
    }
}
