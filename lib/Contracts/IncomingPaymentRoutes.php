<?php

declare(strict_types=1);

namespace OpenPayments\Contracts;

use OpenPayments\OpenApi\Generated\ResourceServer\Model\PublicIncomingPayment;
use OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPayment;
use OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentsGetResponse200 as IncomingPaymentPaginationResult;

use OpenPayments\Models\IncomingPaymentWithPaymentMethods;

interface IncomingPaymentRoutes
{
    /**
     * Get an incoming payment by URL.
     *
     * @param string $url
     * @param string|null $accessToken
     * @return IncomingPaymentWithPaymentMethods
     */
    public function get(string $url): IncomingPaymentWithPaymentMethods;

    /**
     * Get a public incoming payment by URL.
     *
     * @param string $url
     * @return PublicIncomingPayment
     */
    public function getPublic(string $url): PublicIncomingPayment;

    /**
     * Create an incoming payment.
     *
     * @param array $incomingPaymentRequest
     * @param string|null $accessToken
     * @return IncomingPaymentWithPaymentMethods
     */
    public function create( array $incomingPaymentRequest): IncomingPaymentWithPaymentMethods;

    /**
     * Complete an incoming payment.
     *
     * @param string $url
     * @param string|null $accessToken
     * @return IncomingPayment
     */
    public function complete(string $url): IncomingPayment;

    /**
     * List incoming payments.
     *
     * @param array $queryParams
     * @param string|null $accessToken
     * @param array|null $pagination
     * @return IncomingPaymentPaginationResult
     */
    public function list(array $queryParams): IncomingPaymentPaginationResult;
}

