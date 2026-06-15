<?php

declare(strict_types=1);

namespace OpenPayments\DTO;

class CollectionRequestArgs extends GrantOrTokenRequestArgs
{
    public readonly string $walletAddress;

    public function __construct(string $url, string $accessToken, string $walletAddress)
    {
        parent::__construct($url, $accessToken);
        $this->walletAddress = $walletAddress;
    }
}
