<?php

declare(strict_types=1);

namespace OpenPayments\Services;

use OpenPayments\Models\AccessToken;
use OpenPayments\Models\IncomingPaymentAccess;
use OpenPayments\Models\OutgoingPaymentAccess;
use OpenPayments\Models\QuoteAccess;


use OpenPayments\OpenApi\Generated\AuthServer\Client as OpenApiAuthServerClient;

use OpenPayments\Contracts\TokenRoutes;
use Psr\Http\Message\ResponseInterface;
use OpenPayments\Traits\GetIdFromUrl;
use OpenPayments\Validators\TokenValidator;

class TokenService implements TokenRoutes
{
    use GetIdFromUrl;
    private OpenApiAuthServerClient $openApiClient;
    private TokenValidator $validator;

    public function __construct(
        OpenApiAuthServerClient $openApiClient,
        TokenValidator $validator

    ) {
        $this->openApiClient = $openApiClient;
        $this->validator = $validator;
    }

    public function rotate(string $url): AccessToken
    {
        $id = $this->getIdFromUrl($url);

        $response = $this->openApiClient->postToken($id);

        $this->validator->validateRotateTokenResponse($response);

        if (is_array($response)) {
            return $this->buildAccessTokenObject($response['access_token']);
        } else {
            throw new \UnexpectedValueException('Unexpected response type');
        }
    }

    public function revoke(string $url): void
    {
        $id = $this->getIdFromUrl($url);

        $this->openApiClient->deleteToken($id);
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
