<?php

namespace OpenPayments\Models;

use OpenPayments\Traits\ArraySerializableTrait;

class IncomingPayment
{
    use ArraySerializableTrait;

    public ?Amount $receivedAmount;

    public string $authServer;

    public function __construct(array $payment)
    {
        $this->receivedAmount = isset($payment['receivedAmount'])
            ? new Amount(
                (string) $payment['receivedAmount']['value'],
                (string) $payment['receivedAmount']['assetCode'],
                (int) $payment['receivedAmount']['assetScale']
            )
            : null;

        $this->authServer = $payment['authServer'] ?? '';

    }
}
