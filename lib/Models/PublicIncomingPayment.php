<?php

declare(strict_types=1);

namespace OpenPayments\Models;

class PublicIncomingPayment
{
    public readonly string $id;

    public readonly string $status;

    public readonly string $amount;

    public readonly string $assetCode;

    public readonly int $assetScale;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? '';
        $this->status = $data['status'] ?? '';
        $this->amount = $data['amount'] ?? '';
        $this->assetCode = $data['assetCode'] ?? '';
        $this->assetScale = $data['assetScale'] ?? 0;
    }
}
