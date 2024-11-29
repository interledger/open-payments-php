<?php

declare(strict_types=1);

namespace OpenPayments\Contracts;

use OpenPayments\OpenApi\Generated\ResourceServer\Model\PublicIncomingPayment;
use OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPayment;
use OpenPayments\Models\IncomingPaymentWithPaymentMethods;
use OpenPayments\Models\PaginationResult;

interface IncomingPaymentRoutes
{
    /**
     * Get an incoming payment by URL.
     *
     * @param string $url
     * @param string|null $accessToken
     * @return IncomingPaymentWithPaymentMethods
     */
    public function get(string $url, ?string $accessToken = null): IncomingPaymentWithPaymentMethods;

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
     * @param string $url
     * @param array $createArgs
     * @param string|null $accessToken
     * @return IncomingPaymentWithPaymentMethods
     */
    public function create(string $url, array $createArgs, ?string $accessToken = null): IncomingPaymentWithPaymentMethods;

    /**
     * Complete an incoming payment.
     *
     * @param string $url
     * @param string|null $accessToken
     * @return IncomingPayment
     */
    public function complete(string $url, ?string $accessToken = null): IncomingPayment;

    /**
     * List incoming payments.
     *
     * @param string $url
     * @param string|null $accessToken
     * @param array|null $pagination
     * @return PaginationResult
     */
    public function list(string $url, ?string $accessToken = null, ?array $pagination = null): PaginationResult;
}

