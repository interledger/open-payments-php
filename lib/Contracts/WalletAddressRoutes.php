<?php

namespace OpenPayments\Contracts;

use OpenPayments\OpenApi\Generated\WalletAddressServer\Model\WalletAddress;
use OpenPayments\OpenApi\Generated\WalletAddressServer\Model\JsonWebKeySet;
use Psr\Http\Message\ResponseInterface;

interface WalletAddressRoutes
{
    public function get(): WalletAddress;
    public function getKeys(): JsonWebKeySet;
    public function getDIDDocument(): ResponseInterface;
}
