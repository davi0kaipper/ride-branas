<?php

namespace Tests\Unit\ValueObjects;

use PHPUnit\Framework\TestCase;
use Project\Domain\ValueObjects\Cpf;

class CpfTest extends TestCase
{
    public function testCanGetValue(): void
    {
        $cpf = new Cpf('nice_cpf');

        $this->assertEquals('nice_cpf', $cpf->getValue());
    }
}