<?php

declare(strict_types=1);

namespace OpenPayments\Models;

class OutgoingPaymentGrant
{
    public ?Amount $spentReceiveAmount;

    public ?Amount $spentDebitAmount;

    public function __construct(array $data)
    {
        $this->spentReceiveAmount = isset($data['spentReceiveAmount'])
            ? new Amount(
                (string) $data['spentReceiveAmount']['value'],
                (string) $data['spentReceiveAmount']['assetCode'],
                (int) $data['spentReceiveAmount']['assetScale']
            )
            : null;

        $this->spentDebitAmount = isset($data['spentDebitAmount'])
            ? new Amount(
                (string) $data['spentDebitAmount']['value'],
                (string) $data['spentDebitAmount']['assetCode'],
                (int) $data['spentDebitAmount']['assetScale']
            )
            : null;
    }

    /**
     * Convert the model to an associative array.
     */
    public function toArray(): array
    {
        return [
            'spentReceiveAmount' => $this->spentReceiveAmount?->toArray(),
            'spentDebitAmount' => $this->spentDebitAmount?->toArray(),
        ];
    }
}
