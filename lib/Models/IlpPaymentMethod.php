<?php

namespace OpenPayments\Models;

class IlpPaymentMethod
{
    public string $type;
    public string $ilpAddress;
    public string $sharedSecret;

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
            'sharedSecret' => $this->sharedSecret
        ];
    }
}
