<?php

namespace OpenPayments\DTO;

class CollectionRequestArgs extends GrantOrTokenRequestArgs
{
    public string $walletAddress;

    public function __construct(string $url, string $accessToken, string $walletAddress)
    {
        parent::__construct($url, $accessToken);
        $this->walletAddress = $walletAddress;
    }
}
