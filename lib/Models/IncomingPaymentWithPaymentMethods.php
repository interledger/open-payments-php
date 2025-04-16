<?php

namespace OpenPayments\Models;

use OpenPayments\Traits\ArraySerializableTrait;

class IncomingPaymentWithPaymentMethods
{
    use ArraySerializableTrait;

    public string $id;

    public string $walletAddress;

    public bool $completed;

    public ?Amount $incomingAmount;

    public ?Amount $receivedAmount;

    public ?string $expiresAt;

    public ?array $metadata;

    public string $createdAt;

    public string $updatedAt;

    public ?array $methods;

    public function __construct(array $payment)
    {
        $this->id = $payment['id'] ?? '';
        $this->walletAddress = $payment['walletAddress'] ?? '';
        $this->completed = $payment['completed'] ?? false;

        $this->incomingAmount = isset($payment['incomingAmount'])
            ? new Amount(
                (string) $payment['incomingAmount']['value'],
                (string) $payment['incomingAmount']['assetCode'],
                (int) $payment['incomingAmount']['assetScale']
            )
            : null;

        $this->receivedAmount = isset($payment['receivedAmount'])
            ? new Amount(
                (string) $payment['receivedAmount']['value'],
                (string) $payment['receivedAmount']['assetCode'],
                (int) $payment['receivedAmount']['assetScale']
            )
            : null;

        $this->expiresAt = $payment['expiresAt'] ?? null;
        $this->metadata = $payment['metadata'] ?? [];
        $this->createdAt = $payment['createdAt'] ?? '';
        $this->updatedAt = $payment['updatedAt'] ?? '';

        // Convert methods to IlpPaymentMethod objects
        $this->methods = isset($payment['methods'])
            ? array_map(fn ($method) => new IlpPaymentMethod($method), $payment['methods'])
            : null;
    }
}
