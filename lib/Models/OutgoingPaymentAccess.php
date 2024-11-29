<?php

namespace OpenPayments\Models;

use OpenPayments\Models\GrantAccess;

// OutgoingPayment Access Class
class OutgoingPaymentAccess extends GrantAccess
{
    public string $identifier;
    public ?array $limits = null;

    public function __construct(string $type, array $actions, string $identifier, ?array $limits = null)
    {
        $this->type = $type;
        $this->actions = $actions;
        $this->identifier = $identifier;
        $this->limits = $limits;
    }
}