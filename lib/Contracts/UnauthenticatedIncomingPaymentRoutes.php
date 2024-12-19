<?php

namespace OpenPayments\Contracts;

use OpenPayments\DTO\UnauthenticatedResourceRequestArgs;
use OpenPayments\OpenApi\Generated\ResourceServer\Model\PublicIncomingPayment;

interface UnauthenticatedIncomingPaymentRoutes
{
    /**
     * Get a public incoming payment.
     *
     * @param UnauthenticatedResourceRequestArgs $args
     * @return PublicIncomingPayment
     */
    public function get(UnauthenticatedResourceRequestArgs $args): PublicIncomingPayment;
}
