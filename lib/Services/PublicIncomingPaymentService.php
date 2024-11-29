<?php

declare(strict_types=1);

namespace OpenPayments\Services;

use OpenPayments\Contracts\UnauthenticatedIncomingPaymentRoutes;
use OpenPayments\DTO\UnauthenticatedResourceRequestArgs;

use OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPayment;

use OpenPayments\OpenApi\Generated\ResourceServer\Client as OpenApiClient;

class PublicIncomingPaymentService implements UnauthenticatedIncomingPaymentRoutes
{
    private OpenApiClient $openApiClient;

    public function __construct(OpenApiClient $openApiClient)
    {
        $this->openApiClient = $openApiClient;
    }

    public function get(UnauthenticatedResourceRequestArgs $args): IncomingPayment
    {
        $paymentUrl = $args->url;
        $publicIPresponse = $this->openApiClient->getIncomingPayment($paymentUrl);

        // if (!ApiResponseValidator::validateWalletAddress($response)) {
        //     throw new \Exception("Invalid WalletAddress response.");
        // }

        $response = new IncomingPayment($publicIPresponse, 200);
        return $response;
    }

}
