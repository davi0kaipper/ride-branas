<?php

namespace Project\Domain\Exceptions;

use Exception;

class InvalidCarPlateException extends Exception
{
    public function __construct()
    {
        parent::__construct(
            message: 'This car plate is invalid.'
        );
    }
}