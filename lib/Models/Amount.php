<?php

namespace OpenPayments\Models;

class Amount
{   
    public string $value;
    public string $assetCode;
    public int $assetScale;

    public function __construct(string $value, string $assetCode, int $assetScale)
    {
        $this->value = $value;
        $this->assetCode = $assetCode;
        $this->assetScale = $assetScale;
    }

    /**
     * Convert the DTO to an associative array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'value' => $this->value,
            'assetCode' => $this->assetCode,
            'assetScale' => $this->assetScale
        ];
    }

}