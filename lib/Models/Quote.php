<?php

namespace OpenPayments\Models;

use OpenPayments\Traits\ArraySerializableTrait;
use OpenPayments\Models\Amount;

class Quote
{
    use ArraySerializableTrait;

    public string $id;
    public string $walletAddress;
    public string $receiver;
    public ?Amount $receiveAmount;
    public ?Amount $debitAmount;
    public string $method;
    public ?string $expiresAt;
    public string $createdAt;

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
