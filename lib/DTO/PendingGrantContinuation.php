<?php

declare(strict_types=1);

namespace OpenPayments\DTO;

class PendingGrantContinuation
{
    public readonly PendingGrantAccessToken $accessToken;

    public readonly string $uri;

    public readonly ?int $wait;

    /**
     * @param  PendingGrantAccessToken  $accessToken  A unique access token for continuing the request.
     * @param  string  $uri  The URI for continuation requests.
     * @param  int|null  $wait  The time in seconds the client must wait before calling the continuation URI.
     */
    public function __construct(PendingGrantAccessToken $accessToken, string $uri, ?int $wait = null)
    {
        $this->accessToken = $accessToken;
        $this->uri = $uri;
        $this->wait = $wait;
    }
}
