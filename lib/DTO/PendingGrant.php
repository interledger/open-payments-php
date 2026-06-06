<?php

declare(strict_types=1);

namespace OpenPayments\DTO;

class PendingGrant
{
    public readonly PendingGrantInteraction $interact;

    public readonly PendingGrantContinuation $continue;

    public function __construct(
        PendingGrantInteraction $interact,
        PendingGrantContinuation $continue
    ) {
        $this->interact = $interact;
        $this->continue = $continue;
    }
}
