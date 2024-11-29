<?php
namespace OpenPayments\Models;

use OpenPayments\Models\PendingGrantInteract;
use OpenPayments\Models\PendingGrantContinue;

class PendingGrant
{
    public PendingGrantInteract $interact;
    public PendingGrantContinue $continue;

    public function __construct(PendingGrantInteract $interact, PendingGrantContinue $continue)
    {
        $this->interact = $interact;
        $this->continue = $continue;
    }
}