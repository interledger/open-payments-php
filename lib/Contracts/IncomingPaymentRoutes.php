<?php

declare(strict_types=1);

namespace OpenPayments\Contracts;

use OpenPayments\Models\IncomingPayment;
use OpenPayments\Models\IncomingPaymentsList;
use OpenPayments\Models\IncomingPaymentWithPaymentMethods;

interface IncomingPaymentRoutes
{
    /**
     * Get an incoming payment by URL.
     */
    public function get(array $reqParams): IncomingPaymentWithPaymentMethods|IncomingPayment;

    /**
     * Get a public incoming payment by URL.
     */
    public function getPublic(array $reqParams): IncomingPayment;

    /**
     * Create an incoming payment.
     */
    public function create(array $params, array $incomingPaymentRequest): IncomingPaymentWithPaymentMethods;

    /**
     * Complete an incoming payment.
     *
     * @param  string|null  $accessToken
     * @return IncomingPayment
     */
    public function complete(array $params): IncomingPaymentWithPaymentMethods;

    /**
     * List incoming payments.
     */
    public function list(array $queryParams, array $listParams): IncomingPaymentsList;
}
