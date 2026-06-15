<?php

declare(strict_types=1);

namespace OpenPayments\Exceptions;

use Exception;
use OpenPayments\Traits\HasErrorResponse;

class ApiException extends Exception
{
    use HasErrorResponse;

    public static function fromResponse($response): self
    {
        return new self('API error: '.$response->getStatusCode().' '.$response->getBody());
    }
}
