<?php

namespace OpenPayments\Contracts;

use OpenPayments\Models\IncomingPayment;

interface UnauthenticatedIncomingPaymentRoutes
{
    /**
     * Get a public incoming payment.
     */
    public function get(array $args): IncomingPayment;
}
