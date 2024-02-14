<?php

namespace Tests\Unit\ValueObjects;

use PHPUnit\Framework\TestCase;
use Project\Domain\Enums\User\UserType;
use Project\Domain\ValueObjects\CarPlate;
use Project\Domain\ValueObjects\Cpf;

class UserTypeTest extends TestCase
{
    /**
     * @dataProvider values
     */
    public function testCanGetValue($expectedValue, $case): void
    {
        $this->assertEquals($expectedValue, $case->value);
    }

    /**
     * @dataProvider backingValueForDatabase
     */
    public function testBackingValueForDatabase($expectedValue, $case): void
    {
        $this->assertEquals($expectedValue, $case->backingValueForDatabase());
    }

    public static function values()
    {
        yield ['driver', UserType::Driver];
        yield ['passenger', UserType::Passenger];
    }

    public static function backingValueForDatabase()
    {
        yield [1, UserType::Driver];
        yield [2, UserType::Passenger];
    }
}