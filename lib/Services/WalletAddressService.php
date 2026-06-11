<?php

declare(strict_types=1);

namespace OpenPayments\Services;

use OpenPayments\ApiClient;
use OpenPayments\Contracts\WalletAddressRoutes;
use OpenPayments\Models\JsonWebKeySet;
use OpenPayments\Models\WalletAddress;

class WalletAddressService implements WalletAddressRoutes
{
    private ApiClient $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function get(array $requestParams): WalletAddress
    {
        if (! isset($requestParams['url'])) {
            throw new \InvalidArgumentException('Missing required url for get wallet address');
        }
        $walletInfo = $this->apiClient->request('GET', $requestParams['url']);
        if (is_array($walletInfo) && ! isset($walletInfo['error'])) {
            return new WalletAddress($walletInfo);
        } else {
            throw new \UnexpectedValueException('Unexpected response type '.gettype($walletInfo).' '.print_r($walletInfo, true));
        }
    }

    public function getKeys(array $requestParams): JsonWebKeySet
    {
        if (! isset($requestParams['url'])) {
            throw new \InvalidArgumentException('Missing required url for get wallet address keys ');
        }
        $keysInfo = $this->apiClient->request('GET', $requestParams['url'].'/jwks.json');

        return new JsonWebKeySet($keysInfo);
    }

    /**
     * @deprecated since v1.1.0. The DID Document endpoint has been removed from the upstream
     *             Open Payments specification. This method will be removed in v1.2.1.
     *
     * @see https://github.com/interledger/open-payments-specifications
     */
    public function getDIDDocument(array $requestParams): array
    {
        trigger_error(
            'WalletAddressService::getDIDDocument() is deprecated since v1.1.0 and will be removed in v1.2.1. '
            .'The DID Document endpoint has been removed from the Open Payments specification.',
            E_USER_DEPRECATED
        );

        if (! isset($requestParams['url'])) {
            throw new \InvalidArgumentException('Missing required url for get wallet address did document');
        }

        return $this->apiClient->request('GET', $requestParams['url'].'/did.json');
    }
}
