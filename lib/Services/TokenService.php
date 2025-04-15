<?php

declare(strict_types=1);

namespace OpenPayments\Services;

use OpenPayments\ApiClient;
use OpenPayments\Contracts\TokenRoutes;
use OpenPayments\Exceptions\PostTokenBadRequestException;
use OpenPayments\Exceptions\PostTokenNotFoundException;
use OpenPayments\Exceptions\PostTokenUnauthorizedException;
use OpenPayments\Models\AccessToken;
use OpenPayments\Models\IncomingPaymentAccess;
use OpenPayments\Models\OutgoingPaymentAccess;
use OpenPayments\Models\QuoteAccess;
use OpenPayments\Traits\GetIdFromUrl;
use OpenPayments\Validators\TokenValidator;

class TokenService implements TokenRoutes
{
    use GetIdFromUrl;

    private ApiClient $apiClient;

    private TokenValidator $validator;

    public function __construct(
        ApiClient $apiClient

    ) {
        $this->apiClient = $apiClient;
        $this->validator = new TokenValidator;
    }

    public function rotate(array $reqParams): AccessToken
    {
        if (! isset($reqParams['url'])) {
            throw new \InvalidArgumentException('Missing required data');
        }
        if (strpos($reqParams['url'], 'token/') === false) {
            throw new \InvalidArgumentException('Invalid token URL');
        }
        $response = $this->apiClient->request('POST', $reqParams['url']);

        if (is_array($response) && ! isset($response['error'])) {
            return $this->buildAccessTokenObject($response['access_token']);
        } else {
            $status = $response['status_code'] ?? 0;
            if ($status === 400) {
                throw new PostTokenBadRequestException($response['message']);
            } elseif ($status === 401) {
                throw new PostTokenUnauthorizedException($response['message']);
            } elseif ($status === 404) {
                throw new PostTokenNotFoundException($response['message']);
            }
            throw new \UnexpectedValueException('Unexpected response type');
        }
    }

    public function revoke(array $reqParams): mixed
    {
        if (! isset($reqParams['url']) || ! isset($reqParams['access_token'])) {
            throw new \InvalidArgumentException('Missing required data');
        }
        $this->apiClient->setAccessToken($reqParams['access_token']);
        $response = $this->apiClient->request('DELETE', $reqParams['url']);
        if (isset($response['error'])) {
            throw new \Exception('Error: '.print_r($response, true));
        } else {
            return $response;
        }
    }

    private function buildAccessTokenObject(array $tokenData): AccessToken
    {
        $accessData = $tokenData['access'][0] ?? '';
        switch ($accessData['type']) {
            case 'incoming-payment':
                $accessObject = new IncomingPaymentAccess(
                    $accessData['type'],
                    $accessData['actions'],
                    $accessData['identifier'] ?? null
                );
                break;
            case 'outgoing-payment':
                $accessObject = new OutgoingPaymentAccess(
                    $accessData['type'],
                    $accessData['actions'],
                    $accessData['identifier'],
                    $accessData['limits'] ?? null
                );
                break;
            case 'quote':
                $accessObject = new QuoteAccess(
                    $accessData['type'],
                    $accessData['actions']
                );
                break;
            default:
                throw new \InvalidArgumentException("Unknown access type: {$accessData['type']}");
        }

        // Create AccessToken instance
        return new AccessToken(
            $tokenData['value'],
            $tokenData['manage'],
            $accessObject,
            $tokenData['expires_in'] ?? null
        );
    }
}
