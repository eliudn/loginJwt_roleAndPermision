<?php

namespace Src\Management\Auth\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\MixedValueObjects;

class SingUpValueObject extends MixedValueObjects
{
    /**
     * @return array<string,mixed>
     */
    public function handler():array
    {
        return [
            "person_id"=>$this->value()["person_id"],
            "username"=>$this->value()["username"],
            "password"=>$this->hashPassword()
        ];
    }
    /**
     * @return string|bool|null
     */
    private function hashPassword(): string
    {
        return password_hash($this->value()['password'],PASSWORD_DEFAULT);
    }

}
