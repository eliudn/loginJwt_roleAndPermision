<?php

namespace Src\Management\Auth\Application\Auth;

use Src\Management\Auth\Domain\Contracts\JwtAutheticationContract;
use Src\Management\Auth\Domain\ValueObjects\JwtAuthenticationValueObject;

class JwtAuthenticationUseCase
{
    public function __construct(
        private readonly JwtAutheticationContract $jwtAutheticationContract
    )
    {

    }
    /**
     * @return string
     * @param array<int,mixed> $request
     */
    public function __invoke(array $request): string
    {

        return $this->jwtAutheticationContract
            ->auth(new JwtAuthenticationValueObject($request));
    }
}
