<?php

namespace Project\Domain\Exceptions;

class InvalidDocumentException extends \Exception
{
    public function __construct()
    {
        parent::__construct(
            message: 'This car plate is invalid'
        );
    }
}