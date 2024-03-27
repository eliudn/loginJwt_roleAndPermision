<?php

namespace Src\Shared\Domain\ValueObjects;

abstract class IntValueObjects
{
    public function __construct( private readonly int $value)
    {
    }

    public function value():int{
        return $this->value;
    }
}
