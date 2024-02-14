<?php

namespace Tests\Unit\ValueObjects;

use PHPUnit\Framework\TestCase;
use Project\Domain\ValueObjects\CarPlate;
use Project\Domain\ValueObjects\Cpf;

class CarPlateTest extends TestCase
{
    public function testCanGetValue(): void
    {
        $carPlate = new CarPlate('AAA1111');

        $this->assertEquals('AAA1111', $carPlate->getValue());
    }
}