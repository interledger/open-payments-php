<?php

declare(strict_types=1);

namespace OpenPayments\Models;

use OpenPayments\Traits\ArraySerializableTrait;

class IncomingPayment
{
    use ArraySerializableTrait;

    public readonly ?Amount $receivedAmount;

    public readonly string $authServer;

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
