<?php

namespace Tests\Unit\ValueObjects;

use Project\Domain\DTOs\SignUpDto;
use Project\Tests\TestCase;

class SignUpTest extends TestCase
{
    public function testCanSignUpWithCorrectData(): void
    {
        $name = 'fulano da silva';
        $type = 'passenger';
        $email = 'email@da_silva.com';
        $document = $this->faker->cpf;
        $carPlate = null;

        $userDto = new SignUpDto($name, $type, $email, $document, $carPlate);
        var_dump($userDto); die;
        // $user = new User($name, $type, $email, $document, $carPlate);

        // $ucResponse = (new SignUp($userDto))->handle();

        // $this->assertEquals($ucResponse, $exceptionMessage->getMessage());
    }
}