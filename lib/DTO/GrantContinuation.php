<?php

namespace OpenPayments\DTO;

class GrantContinuation
{
    public string $accessTokenValue;

    public string $uri;

    public ?int $wait;

    public function __construct(string $accessTokenValue, string $uri, ?int $wait = null)
    {
        $this->accessTokenValue = $accessTokenValue;
        $this->uri = $uri;
        $this->wait = $wait;
    }
}
