<?php

declare(strict_types=1);

namespace OpenPayments\Models;

class Amount
{
    public readonly string $value;

    public readonly string $assetCode;

    public readonly int $assetScale;

    public function __construct(string $value, string $assetCode, int $assetScale)
    {
        $this->value = $value;
        $this->assetCode = $assetCode;
        $this->assetScale = $assetScale;
    }

    /**
     * Convert the model to an associative array.
     */
    public function toArray(): array
    {
        return [
            'value' => $this->value,
            'assetCode' => $this->assetCode,
            'assetScale' => $this->assetScale,
        ];
    }
}
