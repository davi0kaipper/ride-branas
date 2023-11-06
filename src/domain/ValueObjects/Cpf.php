<?php

namespace Project\Domain\ValueObjects;

class Cpf
{
    public function __construct(readonly private string $value)
    {
        //
    }


    public function getValue(): string
    {
        return $this->value;
    }
}