<?php

namespace Project\Domain\Exceptions;

use Exception;

class UserNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct(
            message: 'A user with this id was not found.'
        );
    }
}