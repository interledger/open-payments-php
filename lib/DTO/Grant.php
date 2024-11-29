<?php

namespace OpenPayments\DTO;

class Grant
{
    public AccessToken $accessToken;
    public ?GrantContinuation $continuation;

    public function __construct(AccessToken $accessToken, ?GrantContinuation $continuation = null)
    {
        $this->accessToken = $accessToken;
        $this->continuation = $continuation;
    }
}
