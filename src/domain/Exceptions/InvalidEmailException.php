<?php

namespace Project\Domain\Exceptions;

use Exception;

class InvalidEmailException extends Exception
{
    public function __construct()
    {
        parent::__construct(
            message: 'This email is invalid.'
        );
    }
}