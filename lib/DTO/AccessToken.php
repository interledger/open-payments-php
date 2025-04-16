<?php

namespace OpenPayments\DTO;

use OpenPayments\DTO\ResourceRequest\IncomingPaymentAccess;
use OpenPayments\DTO\ResourceRequest\OutgoingPaymentAccess;
use OpenPayments\DTO\ResourceRequest\QuoteAccess;

class AccessToken
{
    public string $value;

    public string $manage;

    public IncomingPaymentAccess|OutgoingPaymentAccess|QuoteAccess $access;

    public ?int $expiresIn;

    public function __construct(
        string $value,
        string $manage,
        IncomingPaymentAccess|OutgoingPaymentAccess|QuoteAccess $access,
        ?int $expiresIn = null
    ) {
        $this->value = $value;
        $this->manage = $manage;
        $this->access = $access;
        $this->expiresIn = $expiresIn;
    }

    /**
     * Convert the DTO to an associative array.
     */
    public function toArray(): array
    {
        $array = [
            'value' => $this->value,
            'manage' => $this->manage,
            'access' => $this->access->toArray(),
        ];
        if ($this->expiresIn !== null) {
            $array['expiresIn'] = $this->expiresIn;
        }

        return $array;
    }
}
