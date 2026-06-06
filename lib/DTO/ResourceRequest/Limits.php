<?php

declare(strict_types=1);

namespace OpenPayments\DTO\ResourceRequest;

use OpenPayments\Models\Amount;

class Limits
{
    public readonly ?string $receiver;

    public readonly ?Amount $debitAmount;

    public readonly ?Amount $receiveAmount;

    public readonly ?string $interval;

    public function __construct(
        ?string $receiver = null,
        ?Amount $debitAmount = null,
        ?Amount $receiveAmount = null,
        ?string $interval = null
    ) {
        $this->receiver = $receiver;
        $this->debitAmount = $debitAmount;
        $this->receiveAmount = $receiveAmount;
        $this->interval = $interval;
    }

    /**
     * Convert the DTO to an associative array.
     */
    public function toArray(): array
    {
        $array = [];
        if ($this->receiver !== null) {
            $array['receiver'] = $this->receiver;
        }
        if ($this->debitAmount !== null) {
            $array['debitAmount'] = $this->debitAmount->toArray();
        }
        if ($this->receiveAmount !== null) {
            $array['receiveAmount'] = $this->receiveAmount->toArray();
        }
        if ($this->interval !== null) {
            $array['interval'] = $this->interval;
        }

        return $array;
    }
}
