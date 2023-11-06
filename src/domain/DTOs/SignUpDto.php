<?php

namespace Project\Domain\DTOs;

class SignUpDto
{
    public function __construct(
        public string $name,
        public string $type,
        public string $email,
        public string $document,
        public string|null $car_plate,
    ){
        //
    }


    public function toArray(): array
    {
        return (array) $this;
    }
}