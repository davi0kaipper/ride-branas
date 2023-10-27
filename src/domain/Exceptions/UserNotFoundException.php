<?php

namespace Project\Domain\Exceptions;

class UserNotFoundException extends \Exception
{
    public function __construct()
    {
        parent::__construct(
            message: 'An user with this id was not found.'
        );
    }
}