<?php

namespace Project\Domain\DTOs;

use DateTime;
use Project\Domain\ValueObjects\CarPlate;
use Project\Domain\ValueObjects\Cpf;
use UserType;

class SignUpDto
{
    public function __construct(
        public string $name,
        public string $type,
        public string $email,
        public string $document,
        public string|null $carPlate,
    )
    {
        //
    }

    public function toArray(): array
    {
        return (array) $this;
    }
}