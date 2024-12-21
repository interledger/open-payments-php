<?php

declare(strict_types=1);

namespace OpenPayments\Contracts;

use OpenPayments\OpenApi\Generated\ResourceServer\Model\PublicIncomingPayment;
use OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPayment;
use OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentWithMethods;
use OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentsGetResponse200 as IncomingPaymentPaginationResult;
use OpenPayments\Models\IncomingPaymentWithPaymentMethods;

use OpenPayments\Models\PaginationResult;

interface IncomingPaymentRoutes
{
    /**
     * Get an incoming payment by URL.
     *
     * @param string $url
     * @param string|null $accessToken
     * @return array|IncomingPaymentWithPaymentMethods
     */
    public function get(string $url, ?bool $returnArray = false): array|IncomingPaymentWithPaymentMethods;

    /**
     * Get a public incoming payment by URL.
     *
     * @param string $url
     * @return array|PublicIncomingPayment
     */
    public function getPublic(string $url, ?bool $returnArray = false): array|PublicIncomingPayment;

    /**
     * Create an incoming payment.
     *
     * @param array $incomingPaymentRequest
     * @param string|null $accessToken
     * @return array|IncomingPaymentWithPaymentMethods
     */
    public function create( array $incomingPaymentRequest, ?bool $returnArray = false): array|IncomingPaymentWithMethods;

    /**
     * Complete an incoming payment.
     *
     * @param string $url
     * @param string|null $accessToken
     * @return array|IncomingPayment
     */
    public function complete(string $url, ?bool $returnArray = false): array|IncomingPayment;

    /**
     * List incoming payments.
     *
     * @param array $queryParams
     * @param string|null $accessToken
     * @param array|null $pagination
     * @return array|IncomingPaymentPaginationResult
     */
    public function list(array $queryParams, ?bool $returnArray = false): array|IncomingPaymentPaginationResult;
}

