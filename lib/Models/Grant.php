<?php

namespace OpenPayments\Models;

class Grant
{
    public AccessToken $access_token;

    public GrantContinue $continue;

    public function __construct(AccessToken $access_token, GrantContinue $continue)
    {
        $this->access_token = $access_token;
        $this->continue = $continue;
    }
}
