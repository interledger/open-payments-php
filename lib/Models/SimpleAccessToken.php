<?php

declare(strict_types=1);

namespace OpenPayments\Models;

class SimpleAccessToken
{
    public readonly string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }
}
