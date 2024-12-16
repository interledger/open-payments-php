<?php

namespace OpenPayments\Contracts;

use OpenPayments\DTO\UnauthenticatedResourceRequestArgs;
use OpenPayments\DTO\GrantRequest;
use OpenPayments\DTO\GrantContinuationRequest;
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
     * @param GrantContinuationRequest|null $args
     * @return Grant|GrantContinuation
     */
    public function continue(array $postArgs, ?GrantContinuationRequest $args = null): Grant|GrantContinuation;

    /**
     * Cancel an existing grant.
     *
     * @param UnauthenticatedResourceRequestArgs $postArgs
     * @return void
     */
    public function cancel(UnauthenticatedResourceRequestArgs $postArgs): void;
}
