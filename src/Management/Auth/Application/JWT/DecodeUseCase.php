<?php

namespace Src\Management\Auth\Application\JWT;

use Src\Management\Auth\Domain\Contracts\JwtAutheticationContract;
use Src\Management\Auth\Domain\ValueObjects\LoginJwt;

class DecodeUseCase
{
    public function __construct(
        private readonly JwtAutheticationContract $jwtAutheticationContract
    )
    {
    }

    public function __invoke(string $request): mixed
    {
        return $this->jwtAutheticationContract->get(new LoginJwt($request));
    }
}
