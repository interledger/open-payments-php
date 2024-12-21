<?php


namespace OpenPayments\Services;

use OpenPayments\Contracts\OutgoingPaymentRoutes;
use OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPayment;
use OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPaymentWithSpentAmounts;
use OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPaymentsGetResponse200 as OutgoingPaymentPaginationResult;
use OpenPayments\OpenApi\Generated\ResourceServer\Exception\{
    GetOutgoingPaymentUnauthorizedException,
    GetOutgoingPaymentForbiddenException,
    GetOutgoingPaymentNotFoundException,
    ListOutgoingPaymentsUnauthorizedException,
    ListOutgoingPaymentsForbiddenException,
    CreateOutgoingPaymentUnauthorizedException,
    CreateOutgoingPaymentForbiddenException
};
use OpenPayments\OpenApi\Generated\ResourceServer\Client as OpenApiResourceServerClient;
use OpenPayments\Validators\OutgoingPaymentValidator;
use Psr\Http\Message\ResponseInterface;

class OutgoingPaymentService implements OutgoingPaymentRoutes
{
    private OpenApiResourceServerClient $openApiClient;
    private OutgoingPaymentValidator $validator;

    public function __construct(OpenApiResourceServerClient $openApiClient, OutgoingPaymentValidator $validator)
    {
        $this->openApiClient = $openApiClient;
        $this->validator = $validator;
    }

    /**
     * Fetches the latest state of an outgoing payment by its ID.
     *
     * @param string $id The identifier of the outgoing payment.
     * @param array $headerParameters Headers including `Signature-Input` and `Signature`.
     * @return OutgoingPayment|ResponseInterface|null
     * @throws GetOutgoingPaymentUnauthorizedException
     * @throws GetOutgoingPaymentForbiddenException
     * @throws GetOutgoingPaymentNotFoundException
     */
    public function get(string $id, array $headerParameters): OutgoingPayment
    {
        return $this->openApiClient->getOutgoingPayment($id, $headerParameters);
    }

    /**
     * Lists all outgoing payments on a wallet address.
     *
     * @param array $queryParameters Query parameters for pagination and filtering.
     * @param array $headerParameters Headers including `Signature-Input` and `Signature`.
     * @return OutgoingPaymentPaginationResult|ResponseInterface|null
     * @throws ListOutgoingPaymentsUnauthorizedException
     * @throws ListOutgoingPaymentsForbiddenException
     */
    public function list(array $queryParameters, array $headerParameters): OutgoingPaymentPaginationResult
    {
        return $this->openApiClient->listOutgoingPayments($queryParameters, $headerParameters);
    }

    /**
     * Creates a new outgoing payment.
     *
     * @param mixed $requestBody The body of the request for creating an outgoing payment.
     * @param array $headerParameters Headers including `Signature-Input` and `Signature`.
     * @return OutgoingPaymentWithSpentAmounts|ResponseInterface|array|null
     * @throws CreateOutgoingPaymentUnauthorizedException
     * @throws CreateOutgoingPaymentForbiddenException
     */
    public function create($requestBody, array $headerParameters): array|OutgoingPaymentWithSpentAmounts
    {
        $this->validator->validateRequest($requestBody);
        return $this->openApiClient->createOutgoingPayment($requestBody, $headerParameters);
    }
}
