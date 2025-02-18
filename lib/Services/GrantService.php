<?php

declare(strict_types=1);

namespace OpenPayments\Services;

use OpenPayments\Contracts\GrantRoutes;
use OpenPayments\Validators\GrantValidator;
use OpenPayments\DTO\UnauthenticatedResourceRequestArgs;
use OpenPayments\Models\Grant;
use OpenPayments\Models\PendingGrant;
use OpenPayments\Models\GrantContinuation;
use OpenPayments\OpenApi\Generated\AuthServer\Model\PostBody;
use OpenPayments\OpenApi\Generated\AuthServer\Model\PostBodyAccessToken;
use OpenPayments\OpenApi\Generated\AuthServer\Model\InteractRequest;
use OpenPayments\OpenApi\Generated\AuthServer\Model\ContinueIdPostBody;
use OpenPayments\Transformers\GrantTransformer;
use OpenPayments\Transformers\PendingGrantTransformer;
use OpenPayments\OpenApi\Generated\AuthServer\Client as OpenApiAuthServerClient;


class GrantService implements GrantRoutes
{
    private OpenApiAuthServerClient $openApiClient;

    private GrantValidator $validator;
    public function __construct(
        OpenApiAuthServerClient $openApiClient,
        GrantValidator $validator
    ) {
        $this->openApiClient = $openApiClient;
        $this->validator = $validator;
    }

    public function request(array $grantRequest): PendingGrant|Grant
    {
    
        $this->validator->validateRequest($grantRequest);

        $token = new PostBodyAccessToken();
        $token->setAccess($grantRequest['access_token']['access']);

        $postBody = new PostBody();
        $postBody->setClient($grantRequest['client']);
        $postBody->setAccessToken($token);
        if (isset($grantRequest['interact'])){
            $interact = new InteractRequest($grantRequest['interact']);
            $postBody->setInteract($interact);
        }

        $response = $this->openApiClient->postRequest($postBody);
        $this->validator->validateResponse($response);

        if (isset($response['interact']) && isset($response['continue'])) {
            return PendingGrantTransformer::createPendingGrantFromResponse($response);
        } else {
            return GrantTransformer::createGrantFromResponse($response);
        }
    }

    public function continue(array $continueRequest, ?string $accessToken = null): Grant|GrantContinuation
    {
        // Validate the input
       // $this->validator->validateRequest($continueRequest);

        $response = $this->openApiClient->postContinue($continueRequest['id'], new ContinueIdPostBody($continueRequest));
        $this->validator->validateResponse($response);
        return GrantTransformer::createGrantFromResponse($response);
    }

    public function cancel(UnauthenticatedResourceRequestArgs $postArgs): void
    {
        // TODO: Implement cancel() method.
        //$this->httpClient->delete($postArgs->url);
    }
}
