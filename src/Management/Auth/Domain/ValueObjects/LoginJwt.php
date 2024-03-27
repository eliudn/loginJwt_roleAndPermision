<?php

namespace Src\Management\Auth\Domain\ValueObjects;

use Src\Shared\Domain\Trait\EnvValuesJwt;
use Src\Shared\Domain\ValueObjects\StringValueObjects;

final class LoginJwt extends StringValueObjects
{
    use EnvValuesJwt;
}
