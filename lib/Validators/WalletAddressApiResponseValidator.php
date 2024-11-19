<?php

namespace OpenPayments\Validators;

use OpenPayments\OpenApi\Generated\WalletAddressServer\Model\WalletAddress;
use OpenPayments\OpenApi\Generated\WalletAddressServer\Model\JsonWebKeySet;
use OpenPayments\OpenApi\Generated\WalletAddressServer\Endpoint\GetWalletAddressDidDocument;

class WalletAddressApiResponseValidator
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