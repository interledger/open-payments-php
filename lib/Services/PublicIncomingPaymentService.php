<?php

declare(strict_types=1);

namespace OpenPayments\Services;

use OpenPayments\ApiClient;
use OpenPayments\Contracts\UnauthenticatedIncomingPaymentRoutes;
use OpenPayments\Models\IncomingPayment;

class PublicIncomingPaymentService implements UnauthenticatedIncomingPaymentRoutes
{
    private ApiClient $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function get(array $args): IncomingPayment
    {
        if (! isset($reqParams['url'])) {
            throw new \InvalidArgumentException('Missing required data');
        }
        $publicIPresponse = $this->apiClient->request('GET', $reqParams['url']);

        $response = new IncomingPayment($publicIPresponse, 200);

        return $response;
    }
}
