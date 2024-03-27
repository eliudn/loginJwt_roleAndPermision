<?php

namespace Src\Management\Auth\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\MixedValueObjects;

class AccessTokenValueObject extends MixedValueObjects
{
    /**
     * @param array<int,mixed> $userToken
     */
    public function isTokenOwnerValid(array $userToken):bool
    {
        if (!array_key_exists('user_id',$userToken))
        {
            return false;
        }
        return ($userToken["user_id"] == $this->value()["user_id"] );
;
    }
}
