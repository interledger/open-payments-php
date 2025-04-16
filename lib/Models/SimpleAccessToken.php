<?php

namespace OpenPayments\Models;

class SimpleAccessToken
{
    public string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }
}
