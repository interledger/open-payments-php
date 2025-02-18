<?php

namespace OpenPayments\Contracts;

use OpenPayments\Models\AccessToken;

interface TokenRoutes
{
    /**
     * Rotate an access token and return a new one.
     * 
     * @param string $url Contains manage token 'url'.
     * @return AccessToken The new access token.
     */
    public function rotate(string $url): AccessToken;

    /**
     * Revoke an access token.
     * 
     * @param string $url Contains manage token 'url'.
     * @return void
     */
    public function revoke(string $url): void;
}
