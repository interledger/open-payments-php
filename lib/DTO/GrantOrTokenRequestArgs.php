<?php

namespace OpenPayments\DTO;

class GrantOrTokenRequestArgs extends UnauthenticatedResourceRequestArgs
{
    public string $accessToken;

    public function __construct(string $url, string $accessToken)
    {
        parent::__construct($url);
        $this->accessToken = $accessToken;
    }
}
