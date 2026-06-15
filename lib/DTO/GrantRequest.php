<?php

declare(strict_types=1);

namespace OpenPayments\DTO;

use OpenPayments\Traits\ArraySerializableTrait;

class GrantRequest
{
    use ArraySerializableTrait;

    public readonly BasicAccessToken $accessToken;

    public readonly ?string $client;

    public readonly ?GrantInteraction $interact;

    public function __construct(
        BasicAccessToken $accessToken,
        ?string $client = null,
        ?GrantInteraction $interact = null
    ) {
        $this->accessToken = $accessToken;
        $this->client = $client;
        $this->interact = $interact;
    }

    /**
     * Convert the DTO to an associative array.
     */
    public function toArray(): array
    {
        $array = [
            'accessToken' => $this->accessToken->toArray(),
        ];
        if ($this->client !== null) {
            $array['client'] = $this->client;
        }
        if ($this->interact !== null) {
            $array['interact'] = $this->interact->toArray();
        }

        return $array;
    }
}
