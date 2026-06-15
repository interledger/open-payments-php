<?php

declare(strict_types=1);

namespace OpenPayments\DTO;

class PendingGrantAccessToken
{
    public readonly string $value;

    /**
     * @param  string  $value  The value of the continuation access token.
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }
}
