<?php

declare(strict_types=1);

namespace OpenPayments\Services;

use OpenPayments\Contracts\IncomingPaymentRoutes;


use OpenPayments\OpenApi\Generated\ResourceServer\Model\PublicIncomingPayment;
use OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPayment;
use OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentsPostBody;
use OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentIncomingAmount;
use OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentWithMethods;
use OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentsGetResponse200 as IncomingPaymentPaginationResult;
use OpenPayments\Models\IncomingPaymentWithPaymentMethods;

use OpenPayments\OpenApi\Generated\ResourceServer\Exception\{
    GetIncomingPaymentUnauthorizedException,
    GetIncomingPaymentForbiddenException,
    GetIncomingPaymentNotFoundException,
    CompleteIncomingPaymentNotFoundException,
    CompleteIncomingPaymentConflictException,
    ListIncomingPaymentsForbiddenException,
    CreateIncomingPaymentUnauthorizedException,
    CreateIncomingPaymentForbiddenException
};
// use Psr\Log\LoggerInterface;
use GuzzleHttp\Exception\RequestException;
use OpenPayments\OpenApi\Generated\ResourceServer\Client as OpenApiResourceServerClient;
use OpenPayments\Exceptions\ValidationException;
use OpenPayments\Validators\IncomingPaymentValidator;

class IncomingPaymentService implements IncomingPaymentRoutes
{
    private OpenApiResourceServerClient $openApiClient;
    private IncomingPaymentValidator $validator;

    public function __construct(
        OpenApiResourceServerClient $openApiClient,
        IncomingPaymentValidator $validator
    ) {
        $this->openApiClient = $openApiClient;
        $this->validator = $validator;
    }

    private function getIncomingPaymentIdFromUrl(string $url): string
    {
        $urlParts = explode('/', $url);
        return end($urlParts);
    }
    /**
     * Fetches the latest state of an incoming payment by its ID.
     *
     * @param string $url The identifier of the incoming payment.
     * @param bool|null $returnArray
     * @return IncomingPaymentWithMethods|array
     * @throws GetIncomingPaymentUnauthorizedException
     * @throws GetIncomingPaymentForbiddenException
     * @throws GetIncomingPaymentNotFoundException
     * @throws CompleteIncomingPaymentNotFoundException
     */
    public function get(string $url, ?bool $returnArray = false): array|IncomingPaymentWithMethods
    {
        $id = $this->getIncomingPaymentIdFromUrl($url);

        $response = $this->openApiClient->getIncomingPayment($id);

        $this->validator->validateResponse($response);

        return new IncomingPaymentWithMethods($response);
       
    }
    /**
     * Fetches the latest state of an incoming payment by its ID.
     *
     * @param string $url The identifier of the incoming payment.
     * @param bool|null $returnArray
     * @return IncomingPaymentWithPaymentMethods|array
     * @throws GetIncomingPaymentUnauthorizedException
     * @throws GetIncomingPaymentForbiddenException
     * @throws GetIncomingPaymentNotFoundException
     */
    public function getPublic(string $url, ?bool $returnArray = false): array|PublicIncomingPayment
    {
       
        $response = $this->openApiClient->getIncomingPayment($url);

        if($returnArray) {
            return $response;
        }
        return new PublicIncomingPayment($response, 200);

    }

    /**
     * Creates a new incoming payment.
     *
     * @param array $incomingPaymentRequest The incoming payment request.
     * @param bool|null $returnArray
     * @return IncomingPaymentWithMethods|array
     * @throws CreateIncomingPaymentUnauthorizedException
     * @throws CreateIncomingPaymentForbiddenException
     */
    public function create(
        array $incomingPaymentRequest,
        ?bool $returnArray = false
    ): array|IncomingPaymentWithMethods {
       
        $this->validator->validateRequest($incomingPaymentRequest);

        $amount = new IncomingPaymentIncomingAmount($incomingPaymentRequest['incomingAmount']);

        $createIPArgs = new IncomingPaymentsPostBody();
        $createIPArgs->setWalletAddress($incomingPaymentRequest['walletAddress']);
        $createIPArgs->setIncomingAmount($amount);
        $createIPArgs->setMetadata($incomingPaymentRequest['metadata'] ?? null);

        $createIPArgs->setExpiresAt($incomingPaymentRequest['expiresAt'] ?? (new \DateTime())
            ->add(new \DateInterval('PT10M'))->format("Y-m-d\TH:i:s.v\Z"));
        $payment = $this->openApiClient->createIncomingPayment($createIPArgs);

        $this->validator->validateResponse($payment);

        if($returnArray) {
            return $payment;
        }
        return new IncomingPaymentWithMethods($payment);
        
    }

    /**
     * Completes an incoming payment.
     *
     * @param string $url The identifier of the incoming payment.
     * @param bool|null $returnArray
     * @return IncomingPayment|array
     * @throws CompleteIncomingPaymentUnauthorizedException
     * @throws CompleteIncomingPaymentForbiddenException
     * @throws CompleteIncomingPaymentNotFoundException
     * @throws CompleteIncomingPaymentConflictException
     */
    public function complete(string $url, ?bool $returnArray = false): IncomingPayment
    {
        $id = $this->getIncomingPaymentIdFromUrl($url);
        //CompleteIncomingPayment
        $response = $this->openApiClient->completeIncomingPayment($id);
        if($returnArray) {
            return $response;
        }
        return new IncomingPayment($response);
       
    }

    public function list(
        array $queryParams,
        ?bool $returnArray = false
    ): IncomingPaymentPaginationResult {
        $response = $this->openApiClient->listIncomingPayments([
            'wallet-address' => $queryParams['wallet-address'] ?? null,
        ]);

        return new IncomingPaymentPaginationResult($response);

    }
}
