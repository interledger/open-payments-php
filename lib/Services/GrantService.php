<?php

declare(strict_types=1);

namespace OpenPayments\Services;

use OpenPayments\ApiClient;
use OpenPayments\Contracts\GrantRoutes;
use OpenPayments\Exceptions\DeleteContinueBadRequestException;
use OpenPayments\Exceptions\DeleteContinueNotFoundException;
use OpenPayments\Exceptions\DeleteContinueUnauthorizedException;
use OpenPayments\Exceptions\PostContinueBadRequestException;
use OpenPayments\Exceptions\PostContinueNotFoundException;
use OpenPayments\Exceptions\PostContinueUnauthorizedException;
use OpenPayments\Models\Grant;
use OpenPayments\Models\PendingGrant;
use OpenPayments\Transformers\GrantTransformer;
use OpenPayments\Transformers\PendingGrantTransformer;
use OpenPayments\Validators\GrantValidator;

class GrantService implements GrantRoutes
{
    private ApiClient $apiClient;

    private GrantValidator $validator;

    private GrantTransformer $grantTransformer;

    private PendingGrantTransformer $pendingTransformer;

    private string $clientUrl;

    /**
     * GrantService constructor.
     *
     * @param  GrantValidator|null  $validator
     */
    public function __construct(
        ApiClient $apiClient,
        string $clientUrl = '',
        ?GrantTransformer $grantTransformer = null,
        ?PendingGrantTransformer $pendingTransformer = null
    ) {
        $this->apiClient = $apiClient;
        $this->clientUrl = $clientUrl;
        $this->validator = new GrantValidator;
        $this->grantTransformer = $grantTransformer ?? new GrantTransformer;
        $this->pendingTransformer
            = $pendingTransformer ?? new PendingGrantTransformer;
    }

    public function addClientToStruct(array $grantStructure): array
    {
        $grantStructure['client'] = $this->clientUrl;

        return $grantStructure;
    }

    /**
     * Requests a new grant or pending grant.
     *
     * @param  array  $requestParams  Parameters for the request, including 'url'.
     * @param  array  $grantRequest  The grant request data.
     *
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public function request(array $requestParams, array $grantRequest): Grant|PendingGrant
    {
        if (! isset($requestParams['url'])) {
            throw new \InvalidArgumentException('Missing required data');
        }
        $grantRequest = $this->addClientToStruct($grantRequest);
        $this->validator->validateRequest($grantRequest);
        $url = $requestParams['url'];
        if (substr($url, -1) !== '/') {
            $url .= '/';
        }

        $response = $this->apiClient->request('POST', $url, $grantRequest);

        if (isset($response['error'])) {
            throw new \Exception('Error: '.print_r($response, true));
        }
        if (isset($response['interact']) && isset($response['continue'])) {
            return $this->pendingTransformer->createFromResponse($response);
        } else {
            return $this->grantTransformer->createFromResponse($response);
        }
    }

    public function continue(array $requestParams, array $grantRequest): Grant
    {
        if (! isset($requestParams['url']) || ! isset($requestParams['access_token'])) {
            throw new \InvalidArgumentException('Missing required data');
        }
        if (! isset($grantRequest['interact_ref'])) {
            throw new \InvalidArgumentException('Missing interact_ref in grantRequest');
        }
        if (strpos($requestParams['url'], 'continue/') === false) {
            throw new \InvalidArgumentException('Invalid continuation grant URL');
        }
        $url = $requestParams['url'];
        if (substr($url, -1) !== '/') {
            $url .= '/';
        }
        $this->apiClient->setAccessToken($requestParams['access_token']);
        $grantRequest = $this->addClientToStruct($grantRequest);
        $response = $this->apiClient->request('POST', $url, $grantRequest);

        if (is_array($response) && ! isset($response['error'])) {
            return $this->grantTransformer->createFromResponse($response);
        } else {
            $status = $response['status_code'] ?? 0;

            if ($status === 400) {
                throw new PostContinueBadRequestException($response['message']);
            }
            if ($status === 401) {
                throw new PostContinueUnauthorizedException($response['message']);
            }
            if ($status === 404) {
                throw new PostContinueNotFoundException($response['message']);
            }
            throw new \UnexpectedValueException('Unexpected response '.print_r($response, true));
        }
    }

    public function cancel(array $requestParams): void
    {
        if (! isset($requestParams['url']) || ! isset($requestParams['access_token'])) {
            throw new \InvalidArgumentException('Missing required data');
        }
        $this->apiClient->setAccessToken($requestParams['access_token']);
        $response = $this->apiClient->request('DELETE', $requestParams['url']);

        $status = $response['status_code'] ?? 0;
        if (! isset($response['error']) && $status === 204) {
            return;
        } else {
            if ($status === 400) {
                throw new DeleteContinueBadRequestException($response['message']);
            }
            if ($status === 401) {
                throw new DeleteContinueUnauthorizedException($response['message']);
            }
            if ($status === 404) {
                throw new DeleteContinueNotFoundException($response['message']);
            }

        }
    }
}
