<?php

namespace OpenPayments\Services;

use OpenPayments\Contracts\GrantRoutes;
use OpenPayments\Validators\GrantValidator;
use OpenPayments\DTO\UnauthenticatedResourceRequestArgs;
use OpenPayments\DTO\GrantRequest;
use OpenPayments\DTO\GrantContinuationRequest;
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
use Psr\Http\Message\ResponseInterface;
use stdClass;

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

    public function request(array $grantRequest, bool $returnArray = false): array|PendingGrant|Grant
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

        if($returnArray){
            return $response;
        }
        if (isset($response['interact']) && isset($response['continue'])) {
            return PendingGrantTransformer::createPendingGrantFromResponse($response);
        } else {
            return GrantTransformer::createGrantFromResponse($response);
        }
    }

    public function continue(array $continueRequest, ?string $accessToken = null, ?bool $returnArray = false): array|stdClass|Grant|GrantContinuation
    {
        // Validate the input
       // $this->validator->validateRequest($continueRequest);

        $response = $this->openApiClient->postContinue($continueRequest['id'], new ContinueIdPostBody($continueRequest));
        if($returnArray){
            return $response;
        }
        return GrantTransformer::createGrantFromResponse($response);
    }

    public function cancel(UnauthenticatedResourceRequestArgs $postArgs): void
    {
        // TODO: Implement cancel() method.
        //$this->httpClient->delete($postArgs->url);
    }
}
