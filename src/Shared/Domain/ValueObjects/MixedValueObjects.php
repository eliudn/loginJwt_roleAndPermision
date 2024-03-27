<?php

namespace Src\Shared\Domain\ValueObjects;

abstract class MixedValueObjects
{

    /**
     * @param mixed $valueZX
     */
    public function __construct(
        private readonly mixed $value
    )
    {
    }

    /**
     * @return mixed
     */
    public function value():mixed
    {
        return $this->value;
    }
}
