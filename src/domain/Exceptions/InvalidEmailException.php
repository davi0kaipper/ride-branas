<?php

namespace Project\Domain\Exceptions;

class InvalidEmailException extends \Exception
{
    public function __construct()
    {
        parent::__construct(
            message: 'This email is invalid'
        );
    }
}