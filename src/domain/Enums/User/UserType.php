<?php

namespace Project\Domain\Enums\User;

use Project\Domain\Traits\BackingValuesTrait;

enum UserType: string
{
    use BackingValuesTrait;

    case Driver    = 'driver';
    case Passenger = 'passenger';


    public function backingValueForDatabase(): int
    {
        return match ($this) {
            self::Driver => 1,
            self::Passenger => 2
        };
    }
}