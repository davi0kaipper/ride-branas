<?php

namespace Tests\Unit\ValueObjects;

use PHPUnit\Framework\TestCase;
use Project\Domain\Enums\User\UserType;
use Project\Domain\Exceptions\InvalidDocumentException;
use Project\Domain\Exceptions\UserNotFoundException;
use Project\Domain\ValueObjects\CarPlate;
use Project\Domain\ValueObjects\Cpf;

class UserNotFoundExceptionTest extends TestCase
{
    public function testMessageIsCorrect(): void
    {
        $expectedMessage = 'A user with this id was not found.';
        $exceptionMessage = new UserNotFoundException();
        $this->assertEquals($expectedMessage, $exceptionMessage->getMessage());
    }
}