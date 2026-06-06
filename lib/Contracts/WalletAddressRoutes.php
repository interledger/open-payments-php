<?php

namespace OpenPayments\Contracts;

use OpenPayments\Models\JsonWebKeySet;
use OpenPayments\Models\WalletAddress;

interface WalletAddressRoutes
{
    public function get(array $requestParams): WalletAddress;

    public function getKeys(array $requestParams): JsonWebKeySet;

    /**
     * @deprecated since v1.1.0. The DID Document endpoint has been removed from the upstream
     *             Open Payments specification. This method will be removed in v1.2.1.
     *
     * @see https://github.com/interledger/open-payments-specifications
     */
    public function getDIDDocument(array $requestParams): array;
}
