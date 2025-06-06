<?php

namespace OpenPayments\Exceptions;

class ConflictException extends \RuntimeException implements ClientException
{
    public function __construct(string $message)
    {
        parent::__construct($message, 409);
    }
}
