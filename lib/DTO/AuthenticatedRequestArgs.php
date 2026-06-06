<?php

declare(strict_types=1);

namespace OpenPayments\DTO;

class AuthenticatedRequestArgs
{
    public readonly string $accessToken;

    public function __construct(string $accessToken)
    {
        $this->accessToken = $accessToken;
    }
}
