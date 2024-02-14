<?php

namespace Tests\Unit\ValueObjects;

use PHPUnit\Framework\TestCase;
use Project\Domain\ValueObjects\Cpf;
use Project\Domain\ValueObjects\Email;

class EmailTest extends TestCase
{
    public function testCanGetValue(): void
    {
        $email = new Email('nice@email.com');

        $this->assertEquals('nice@email.com', $email->getValue());
    }
}