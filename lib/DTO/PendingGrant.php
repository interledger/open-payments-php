<?php

namespace OpenPayments\DTO;

class PendingGrant
{
    public PendingGrantInteraction $interact;

    public PendingGrantContinuation $continue;

    public function __construct(
        PendingGrantInteraction $interact,
        PendingGrantContinuation $continue
    ) {
        $this->interact = $interact;
        $this->continue = $continue;
    }
}
