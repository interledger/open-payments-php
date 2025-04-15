<?php

namespace OpenPayments\DTO;

use OpenPayments\Traits\ArraySerializableTrait;

// class GrantRequest
// {
//     public function __construct(
//         public string $scope,
//         public string $interact,
//         public ?string $client = null // 'client' can be omitted if null
//     ) {}
// }
// use OpenPayments\DTO\ResourceRequest\IncomingPaymentAccess;
// use OpenPayments\DTO\ResourceRequest\OutgoingPaymentAccess;
// use OpenPayments\DTO\ResourceRequest\QuoteAccess;

class GrantRequest
{
    use ArraySerializableTrait;

    public BasicAccessToken $accessToken;

    public ?string $client;

    public ?GrantInteraction $interact;

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
