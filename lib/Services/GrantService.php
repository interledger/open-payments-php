<?php

namespace OpenPayments\Services;

use OpenPayments\Contracts\GrantRoutes;
use OpenPayments\DTO\UnauthenticatedResourceRequestArgs;
use OpenPayments\DTO\GrantRequest;
use OpenPayments\DTO\GrantContinuationRequest;
use OpenPayments\Models\Grant;
use OpenPayments\Models\PendingGrant;
use OpenPayments\Models\GrantContinuation;
use OpenPayments\OpenApi\Generated\AuthServer\Model\PostBody;
use OpenPayments\OpenApi\Generated\AuthServer\Model\PostBodyAccessToken;
use OpenPayments\Transformers\GrantTransformer;
use OpenPayments\Transformers\PendingGrantTransformer;
use OpenPayments\OpenApi\Generated\AuthServer\Client as OpenApiAuthServerClient;


class GrantService implements GrantRoutes
{
    private OpenApiAuthServerClient $openApiClient;
    public function __construct(
        OpenApiAuthServerClient $openApiClient
    ) {
        $this->openApiClient = $openApiClient;
    }

    public function request(UnauthenticatedResourceRequestArgs $postArgs, GrantRequest $args): PendingGrant|Grant
    {
        $token = new PostBodyAccessToken();
        $token->setAccess($args->accessToken->access);

        $postBody = new PostBody();
        $postBody->setClient($args->client);
        $postBody->setAccessToken($token);

        $response = $this->openApiClient->postRequest($postBody);

        if (isset($response->interact) && isset($response->continue)) {
            return PendingGrantTransformer::createPendingGrantFromResponse($response);
        } else {
            return GrantTransformer::createGrantFromResponse($response);
        }
    }

    public function continue(UnauthenticatedResourceRequestArgs $postArgs, ?GrantContinuationRequest $args = null): Grant|GrantContinuation
    {
        // TODO: Implement continue() method.
        return GrantTransformer::createGrantFromResponse(new \Psr\Http\Message\ResponseInterface());
    }

    public function cancel(UnauthenticatedResourceRequestArgs $postArgs): void
    {
        // TODO: Implement cancel() method.
        //$this->httpClient->delete($postArgs->url);
    }
}
