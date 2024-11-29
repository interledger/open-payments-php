<?php

namespace OpenPayments\DTO;

class AuthenticatedRequestArgs
{
    public string $accessToken;

    public function __construct(string $accessToken)
    {
        $this->accessToken = $accessToken;
    }
}
