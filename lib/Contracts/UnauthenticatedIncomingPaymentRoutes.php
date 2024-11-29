<?php

namespace OpenPayments\Contracts;

use OpenPayments\DTO\UnauthenticatedResourceRequestArgs;
use OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPayment;

interface UnauthenticatedIncomingPaymentRoutes
{
    /**
     * Get a public incoming payment.
     *
     * @param UnauthenticatedResourceRequestArgs $args
     * @return IncomingPayment
     */
    public function get(UnauthenticatedResourceRequestArgs $args): IncomingPayment;
}
