<?php

declare(strict_types=1);

namespace OpenPayments\DTO;

class GrantOrTokenRequestArgs extends UnauthenticatedResourceRequestArgs
{
    public readonly string $accessToken;

    public function __construct(string $url, string $accessToken)
    {
        parent::__construct($url);
        $this->accessToken = $accessToken;
    }
}
