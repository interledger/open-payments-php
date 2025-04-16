<?php

namespace OpenPayments\DTO;

use OpenPayments\DTO\ResourceRequest\IncomingPaymentRequest;
use OpenPayments\DTO\ResourceRequest\OutgoingPaymentRequest;
use OpenPayments\DTO\ResourceRequest\QuoteRequest;

class BasicAccessToken
{
    public array $access = [];

    public function __construct(IncomingPaymentRequest|OutgoingPaymentRequest|QuoteRequest $access)
    {
        $this->access[] = $access;
    }

    /**
     * Convert ChildDTO to an associative array.
     */
    public function toArray(): array
    {
        return [
            'access' => $this->access,
        ];
    }
}
