<?php

namespace OpenPayments\Models;

class PublicIncomingPayment
{
    public string $id;
    public string $status;
    public string $amount;
    public string $assetCode;
    public int $assetScale;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? '';
        $this->status = $data['status'] ?? '';
        $this->amount = $data['amount'] ?? '';
        $this->assetCode = $data['assetCode'] ?? '';
        $this->assetScale = $data['assetScale'] ?? 0;
    }
}
