<?php

namespace OpenPayments\Models;

use OpenPayments\Models\AccessToken;

// Continue Class for Grant
/**
 * GrantContinue
 */
class GrantContinue
{
    public AccessToken $access_token;
    public string $uri;
    public ?int $wait = null;

    public function __construct(AccessToken $access_token, string $uri, ?int $wait = null)
    {
        $this->access_token = $access_token;
        $this->uri = $uri;
        $this->wait = $wait;
    }
}