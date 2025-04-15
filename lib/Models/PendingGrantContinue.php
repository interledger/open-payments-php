<?php

namespace OpenPayments\Models;

class PendingGrantContinue
{
    public SimpleAccessToken $access_token;

    public string $uri;

    public ?int $wait = null;

    public function __construct(SimpleAccessToken $access_token, string $uri, ?int $wait = null)
    {
        $this->access_token = $access_token;
        $this->uri = $uri;
        $this->wait = $wait;
    }
}
