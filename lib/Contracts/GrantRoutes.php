<?php

namespace OpenPayments\Contracts;

use OpenPayments\Models\Grant;
use OpenPayments\Models\PendingGrant;

interface GrantRoutes
{
    /**
     * Request a new grant.
     */
    public function request(array $requestParams, array $grantRequest): Grant|PendingGrant;

    /**
     * Continue an existing grant.
     */
    public function continue(array $requestParams, array $grantRequest): Grant;

    /**
     * Cancel an existing grant.
     */
    public function cancel(array $requestParams): void;
}
