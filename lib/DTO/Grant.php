<?php

declare(strict_types=1);

namespace OpenPayments\DTO;

class Grant
{
    public readonly AccessToken $accessToken;

    public readonly ?GrantContinuation $continuation;

    public function __construct(AccessToken $accessToken, ?GrantContinuation $continuation = null)
    {
        $this->accessToken = $accessToken;
        $this->continuation = $continuation;
    }
}
