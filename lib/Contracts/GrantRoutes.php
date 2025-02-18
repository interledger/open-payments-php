<?php

namespace OpenPayments\Contracts;

use OpenPayments\DTO\UnauthenticatedResourceRequestArgs;
use OpenPayments\Models\Grant;
use OpenPayments\Models\PendingGrant;
use OpenPayments\Models\GrantContinuation;


interface GrantRoutes
{
    /**
     * Request a new grant.
     *
     * @param array $args
     * @return PendingGrant|Grant
     */
    public function request(array $args): PendingGrant|Grant;

    /**
     * Continue an existing grant.
     *
     * @param array $postArgs
     * @param string|null $accessToken
     * @return Grant|GrantContinuation
     */
    public function continue(array $postArgs, ?string $accessToken = null): Grant|GrantContinuation;

    /**
     * Cancel an existing grant.
     *
     * @param UnauthenticatedResourceRequestArgs $postArgs
     * @return void
     */
    public function cancel(UnauthenticatedResourceRequestArgs $postArgs): void;
}
