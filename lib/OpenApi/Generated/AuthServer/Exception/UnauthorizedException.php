<?php

namespace OpenPayments\OpenApi\Generated\AuthServer\Exception;

class UnauthorizedException extends \RuntimeException implements ClientException
{
    public function __construct(string $message)
    {
        parent::__construct($message, 401);
    }
}