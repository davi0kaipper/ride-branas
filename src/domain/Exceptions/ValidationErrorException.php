<?php

namespace Project\Domain\Exceptions;

use Exception;

class ValidationErrorException extends Exception
{
    public function __construct(array $data)
    {
        $message = json_encode($data);

        parent::__construct($message);
    }
}