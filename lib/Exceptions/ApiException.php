<?php

declare(strict_types=1);

namespace OpenPayments\Exceptions;

use Exception;

class ApiException extends Exception
{
    public static function fromResponse($response): self
    {
        return new self('API error: '.$response->getStatusCode().' '.$response->getBody());
    }
}
