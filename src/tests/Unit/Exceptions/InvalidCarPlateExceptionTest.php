<?php

namespace Tests\Unit\ValueObjects;

use PHPUnit\Framework\TestCase;
use Project\Domain\Enums\User\UserType;
use Project\Domain\Exceptions\InvalidCarPlateException;
use Project\Domain\Exceptions\InvalidDocumentException;
use Project\Domain\ValueObjects\CarPlate;
use Project\Domain\ValueObjects\Cpf;

class InvalidCarPlateExceptionTest extends TestCase
{
    public function testMessageIsCorrect(): void
    {
        $expectedMessage = 'This car plate is invalid.';
        $exceptionMessage = new InvalidCarPlateException();
        $this->assertEquals($expectedMessage, $exceptionMessage->getMessage());
    }
}