<?php

declare(strict_types=1);

namespace OpenPayments\Services;

use OpenPayments\OpenApi\Generated\WalletAddressServer\Client as OpenApiClient;
use OpenPayments\OpenApi\Generated\WalletAddressServer\Model\WalletAddress;
use OpenPayments\OpenApi\Generated\WalletAddressServer\Model\JsonWebKeySet;
use Psr\Http\Message\ResponseInterface;

use OpenPayments\Validators\WalletAddressApiResponseValidator as ApiResponseValidator;

interface WalletAddressRoutes
{
    public function get(): WalletAddress;
    public function getKeys(): JsonWebKeySet;
    public function getDIDDocument(): ResponseInterface;
}


class WalletAddressService implements WalletAddressRoutes
{
    private OpenApiClient $openApiClient;

    public function __construct(OpenApiClient $openApiClient)
    {
        $this->openApiClient = $openApiClient;
    }

    public function get(): WalletAddress
    {
        $response = $this->openApiClient->getWalletAddress();
        if (!ApiResponseValidator::validateWalletAddress($response)) {
            throw new \Exception("Invalid WalletAddress response.");
        }
        return $response;
    }

    public function getKeys(): JsonWebKeySet
    {
        $response = $this->openApiClient->getWalletAddressKeys();
        if (!ApiResponseValidator::validateJWKS($response)) {
            throw new \Exception("Invalid JWKS response.");
        }
        return $response;
    }

    public function getDIDDocument(): ResponseInterface
    {
        $response = $this->openApiClient->getWalletAddressDidDocument();
        if (!ApiResponseValidator::validateDIDDocument($response)) {
            throw new \Exception("Invalid DIDDocument response.");
        }
        return $response;
    }
}
