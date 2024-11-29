<?php

namespace OpenPayments\DTO;

class PendingGrantAccessToken
{
    public string $value;

    /**
     * @param string $value The value of the continuation access token.
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }
}
