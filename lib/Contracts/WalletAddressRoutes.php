<?php

namespace OpenPayments\Contracts;

use OpenPayments\Models\JsonWebKeySet;
use OpenPayments\Models\WalletAddress;

interface WalletAddressRoutes
{
    public function get(array $requestParams): WalletAddress;

    public function getKeys(array $requestParams): JsonWebKeySet;

    public function getDIDDocument(array $requestParams): array;
}
