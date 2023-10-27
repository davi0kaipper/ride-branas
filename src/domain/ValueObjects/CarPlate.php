<?php

namespace Project\Domain\ValueObjects;

class CarPlate
{
    public function __construct(readonly private string|null $value)
    {
        //
    }

    public function getValue(): string|null
    {
        return $this->value;
    }
}