<?php

namespace Project\Domain\ValueObjects;

use Project\Domain\Exceptions\InvalidEmailException;

class Email
{
    public function __construct(readonly private string $value)
    {
        if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException();
        }
    }

    public function getValue(): string
    {
        return $this->value;
    }
}