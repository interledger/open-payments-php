<?php

namespace OpenPayments\Exceptions;

use OpenPayments\Traits\HasErrorResponse;

class ForbiddenException extends \RuntimeException implements ClientException
{
    use HasErrorResponse;

    public function __construct(string $message)
    {
        parent::__construct($message, 403);
    }
}
