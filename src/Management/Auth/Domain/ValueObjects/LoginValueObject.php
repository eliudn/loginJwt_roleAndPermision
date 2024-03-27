<?php

namespace Src\Management\Auth\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\MixedValueObjects;

final class LoginValueObject extends MixedValueObjects
{
    /**
     * @return bool
     */
    public function checkPassword(string $password): bool
    {
        return password_verify($this->value()["password"],$password);
    }
    /**
     * @return mixed
     */
    public function has()
    {
        return $this->value()["password"];
    }
}
