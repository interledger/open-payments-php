<?php

declare(strict_types=1);

namespace OpenPayments\Models;

use OpenPayments\Traits\ArraySerializableTrait;

class Quote
{
    use ArraySerializableTrait;

    public readonly string $id;

    public readonly string $walletAddress;

    public readonly string $receiver;

    public readonly ?Amount $receiveAmount;

    public readonly ?Amount $debitAmount;

    public readonly string $method;

    public readonly ?string $expiresAt;

    public readonly string $createdAt;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? '';
        $this->walletAddress = $data['walletAddress'] ?? '';
        $this->receiver = $data['receiver'] ?? '';

        $this->receiveAmount = isset($data['receiveAmount'])
            ? new Amount(
                (string) $data['receiveAmount']['value'],
                (string) $data['receiveAmount']['assetCode'],
                (int) $data['receiveAmount']['assetScale']
            )
            : null;

        $this->debitAmount = isset($data['debitAmount'])
            ? new Amount(
                (string) $data['debitAmount']['value'],
                (string) $data['debitAmount']['assetCode'],
                (int) $data['debitAmount']['assetScale']
            )
            : null;

        $this->method = $data['method'] ?? '';
        $this->expiresAt = $data['expiresAt'] ?? null;
        $this->createdAt = $data['createdAt'] ?? '';
    }
}
