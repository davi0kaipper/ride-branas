<?php

namespace Project\Domain\Traits;

trait BackingValuesTrait
{
    public static function backingValues(): array
    {
        $backingValues = [];

        foreach (self::cases() as $case) {
            $backingValues[$case->value] = $case->value;
        }

        return $backingValues;
    }
}