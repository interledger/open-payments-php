<?php

namespace OpenPayments\DTO;
use OpenPayments\Traits\ArraySerializableTrait;

class NonInteractiveGrantRequest
{
    use ArraySerializableTrait;
    public BasicAccessToken $accessToken;
    public string $client;

    public function __construct(BasicAccessToken $accessToken, string $client)
    {
        $this->accessToken = $accessToken;
        $this->client = $client;
    }
}
