<?php

declare(strict_types=1);

namespace OpenPayments\Models;

class PendingGrant
{
    public readonly PendingGrantInteract $interact;

    public readonly PendingGrantContinue $continue;

    public function __construct(PendingGrantInteract $interact, PendingGrantContinue $continue)
    {
        $this->interact = $interact;
        $this->continue = $continue;
    }
}
