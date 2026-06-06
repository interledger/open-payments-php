<?php

declare(strict_types=1);

namespace OpenPayments\Models;

class AccessToken
{
    public readonly string $value;

    public readonly string $manage;

    public readonly ?int $expires_in;

    public readonly GrantAccess $access;

    public function __construct(string $value, string $manage, GrantAccess $access, ?int $expires_in = null)
    {
        $this->value = $value;
        $this->manage = $manage;
        $this->access = $access;
        $this->expires_in = $expires_in;
    }
}
