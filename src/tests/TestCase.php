<?php

namespace Project\Tests;

use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase as PhpUnitTestCase;
class TestCase extends PhpUnitTestCase
{
    public Generator $faker;
    public function __construct()
    {
        parent::__construct('');
        $this->faker = Factory::create('br_PT');;
    }
}