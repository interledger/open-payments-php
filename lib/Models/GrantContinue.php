<?php

declare(strict_types=1);

namespace OpenPayments\Models;

// Continue Class for Grant
/**
 * GrantContinue
 */
class GrantContinue
{
    public readonly AccessToken|SimpleAccessToken $access_token;

    public readonly string $uri;

    public readonly ?int $wait;

    public function __construct(AccessToken|SimpleAccessToken $access_token, string $uri, ?int $wait = null)
    {
        $this->access_token = $access_token;
        $this->uri = $uri;
        $this->wait = $wait;
    }
}
