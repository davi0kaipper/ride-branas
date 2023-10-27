<?php

namespace Project\Domain\Enums\User;

enum UserType: string
{
    case Driver = 'driver';
    case Passenger = 'passenger';

    public function backingValueForDatabase(): int
    {
        return match ($this) {
            self::Driver => 1,
            self::Passenger => 2
        };
    }
}