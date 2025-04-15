<?php

namespace OpenPayments\Models;

// IncomingPayment Access Class
class IncomingPaymentAccess extends GrantAccess
{
    public ?string $identifier = null;

    public function __construct(string $type, array $actions, ?string $identifier = null)
    {
        $this->type = $type;
        $this->actions = $actions;
        $this->identifier = $identifier;
    }
}
