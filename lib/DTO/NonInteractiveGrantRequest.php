<?php

declare(strict_types=1);

namespace OpenPayments\DTO;

use OpenPayments\Traits\ArraySerializableTrait;

class NonInteractiveGrantRequest
{
    use ArraySerializableTrait;

    public readonly BasicAccessToken $accessToken;

    public readonly string $client;

    public function __construct(BasicAccessToken $accessToken, string $client)
    {
        $this->accessToken = $accessToken;
        $this->client = $client;
    }
}
