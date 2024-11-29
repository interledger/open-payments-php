<?php

namespace OpenPayments\Models;

use OpenPayments\Models\GrantAccess;

class AccessToken
{
    public string $value;
    public string $manage;
    public ?int $expires_in = null;
    public GrantAccess $access;

    public function __construct(string $value, string $manage, GrantAccess $access, ?int $expires_in = null)
    {
        $this->value = $value;
        $this->manage = $manage;
        $this->access = $access;
        $this->expires_in = $expires_in;
    }
}