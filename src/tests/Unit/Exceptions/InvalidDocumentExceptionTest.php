<?php

namespace Tests\Unit\ValueObjects;

use PHPUnit\Framework\TestCase;
use Project\Domain\Enums\User\UserType;
use Project\Domain\Exceptions\InvalidDocumentException;
use Project\Domain\ValueObjects\CarPlate;
use Project\Domain\ValueObjects\Cpf;

class InvalidDocumentExceptionTest extends TestCase
{
    public function testMessageIsCorrect(): void
    {
        $expectedMessage = 'This document is invalid.';
        $exceptionMessage = new InvalidDocumentException();
        $this->assertEquals($expectedMessage, $exceptionMessage->getMessage());
    }
}