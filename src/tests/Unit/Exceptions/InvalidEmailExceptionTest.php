<?php

namespace Tests\Unit\ValueObjects;

use PHPUnit\Framework\TestCase;
use Project\Domain\Enums\User\UserType;
use Project\Domain\Exceptions\InvalidDocumentException;
use Project\Domain\Exceptions\InvalidEmailException;
use Project\Domain\ValueObjects\CarPlate;
use Project\Domain\ValueObjects\Cpf;

class InvalidEmailExceptionTest extends TestCase
{
    public function testMessageIsCorrect(): void
    {
        $expectedMessage = 'This email is invalid.';
        $exceptionMessage = new InvalidEmailException();
        $this->assertEquals($expectedMessage, $exceptionMessage->getMessage());
    }
}