<?php

namespace Src\Management\Auth\Application\Auth;

use Src\Management\Auth\Domain\Contracts\JwtAutheticationContract;
use Src\Management\Auth\Domain\ValueObjects\LoginJwt;

final class CheckTokenAutheticationUseCase
{
    public function __construct(
        private readonly JwtAutheticationContract $jwtAutheticationContract
    )
    {

    }
    /**
     * @return bool
     */
    public function __invoke(string $jwt): bool
    {
        return $this->jwtAutheticationContract->check(new LoginJwt($jwt));
    }
}
