<?php

declare(strict_types=1);

namespace OpenPayments\Services;

use OpenPayments\OpenApi\Generated\WalletAddressServer\Client as OpenApiClient;
use OpenPayments\OpenApi\Generated\WalletAddressServer\Model\WalletAddress;
use OpenPayments\OpenApi\Generated\WalletAddressServer\Endpoint\GetWalletAddressDidDocument;
use OpenPayments\OpenApi\Generated\WalletAddressServer\Model\JsonWebKeySet;
use Psr\Http\Message\ResponseInterface;

interface WalletAddressRoutes
{
    public function get(array $args): WalletAddress;
    public function getKeys(array $args): JsonWebKeySet;
    public function getDIDDocument(array $args): ResponseInterface;
}

class ApiResponseValidator
{
    public static function validateWalletAddress($response): bool
    {
        return $response instanceof WalletAddress;
    }

    public static function validateJWKS($response): bool
    {
        return $response instanceof JsonWebKeySet;
    }

    public static function validateDIDDocument($response): bool
    {
        return $response instanceof GetWalletAddressDidDocument;
    }
}

class WalletAddressService implements WalletAddressRoutes
{
    private OpenApiClient $openApiClient;

    public function __construct(OpenApiClient $openApiClient)
    {
        $this->openApiClient = $openApiClient;
    }

    public function get(array $args): WalletAddress
    {
        $response = $this->openApiClient->getWalletAddress();
        if (!ApiResponseValidator::validateWalletAddress($response)) {
            throw new \Exception("Invalid WalletAddress response.");
        }
        return $response;
    }

    public function getKeys(array $args): JsonWebKeySet
    {
        $response = $this->openApiClient->getWalletAddressKeys();
        if (!ApiResponseValidator::validateJWKS($response)) {
            throw new \Exception("Invalid JWKS response.");
        }
        return $response;
    }

    public function getDIDDocument(array $args): ResponseInterface
    {
        $response = $this->openApiClient->getWalletAddressDidDocument();
        if (!ApiResponseValidator::validateDIDDocument($response)) {
            throw new \Exception("Invalid DIDDocument response.");
        }
        return $response;
    }
}
