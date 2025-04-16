<?php

namespace OpenPayments\Validators;

use OpenPayments\Models\JsonWebKeySet;
use OpenPayments\Models\WalletAddress;

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
        return false;
    }
}
