<?php

namespace OpenPayments\Models;

// Quote Access Class
class QuoteAccess extends GrantAccess
{
    public function __construct(string $type, array $actions)
    {
        $this->type = $type;
        $this->actions = $actions;
    }
}
