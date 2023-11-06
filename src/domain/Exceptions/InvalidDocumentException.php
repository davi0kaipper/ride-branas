<?php

namespace Project\Domain\Exceptions;

use Exception;

class InvalidDocumentException extends Exception
{
    public function __construct()
    {
        parent::__construct(
            message: 'This document is invalid.'
        );
    }
}