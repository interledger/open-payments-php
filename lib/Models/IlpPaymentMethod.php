<?php

declare(strict_types=1);

namespace OpenPayments\Models;

class IlpPaymentMethod
{
    public readonly string $type;

    public readonly string $ilpAddress;

    public readonly string $sharedSecret;

    public function __construct(array $data)
    {
        $this->type = $data['type'] ?? '';
        $this->ilpAddress = $data['ilpAddress'] ?? '';
        $this->sharedSecret = $data['sharedSecret'] ?? '';
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'ilpAddress' => $this->ilpAddress,
            'sharedSecret' => $this->sharedSecret,
        ];
    }
}
