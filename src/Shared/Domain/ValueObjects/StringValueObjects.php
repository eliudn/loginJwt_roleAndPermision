<?php

namespace Src\Shared\Domain\ValueObjects;

abstract class StringValueObjects
{
    public function __construct( private readonly string $value)
    {
    }

    public function value():string{
        return $this->value;
    }
}
