<?php

namespace OpenPayments\Contracts;

use OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPayment;
use OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPaymentWithSpentAmounts;
use OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPaymentsGetResponse200 as OutgoingPaymentPaginationResult;
use Psr\Http\Message\ResponseInterface;

interface OutgoingPaymentRoutes
{
    /**
     * Fetches the latest state of an outgoing payment by its ID.
     *
     * @param string $id The identifier of the outgoing payment.
     * @param array $headerParameters Headers including `Signature-Input` and `Signature`.
     * @return OutgoingPayment|ResponseInterface|null
     */
    public function get(string $id, array $headerParameters): OutgoingPayment;

    /**
     * Lists all outgoing payments on a wallet address.
     *
     * @param array $queryParameters Query parameters for pagination and filtering.
     * @param array $headerParameters Headers including `Signature-Input` and `Signature`.
     * @return OutgoingPaymentPaginationResult|ResponseInterface|null
     */
    public function list(array $queryParameters, array $headerParameters): OutgoingPaymentPaginationResult;

    /**
     * Creates a new outgoing payment.
     *
     * @param mixed $requestBody The body of the request for creating an outgoing payment.
     * @param array $headerParameters Headers including `Signature-Input` and `Signature`.
     * @return OutgoingPaymentWithSpentAmounts|ResponseInterface|null
     */
    public function create($requestBody, array $headerParameters): OutgoingPaymentWithSpentAmounts;
}
