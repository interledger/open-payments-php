<?php

namespace OpenPayments\Contracts;

use OpenPayments\Models\AccessToken;

interface TokenRoutes
{
    /**
     * Rotate an access token and return a new one.
     *
     * @param  array  $reqParams  Contains manage token 'url'.
     * @return AccessToken The new access token.
     */
    public function rotate(array $reqParams): AccessToken;

    /**
     * Revoke an access token.
     *
     * @param  array  $reqParams  Contains manage token 'url'.
     */
    public function revoke(array $reqParams): mixed;
}
