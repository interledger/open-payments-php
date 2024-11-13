<?php

namespace OpenPayments\OpenApi\Generated\WalletAddressServer;

class Client extends \OpenPayments\OpenApi\Generated\WalletAddressServer\Runtime\Client\Client
{
    /**
     * @param  string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \OpenPayments\OpenApi\Generated\WalletAddressServer\Exception\GetWalletAddressNotFoundException
     *
     * @return null|\OpenPayments\OpenApi\Generated\WalletAddressServer\Model\WalletAddress|\Psr\Http\Message\ResponseInterface
     */
    public function getWalletAddress(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \OpenPayments\OpenApi\Generated\WalletAddressServer\Endpoint\GetWalletAddress(), $fetch);
    }
    /**
     * @param  string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \OpenPayments\OpenApi\Generated\WalletAddressServer\Exception\GetWalletAddressKeysNotFoundException
     *
     * @return null|\OpenPayments\OpenApi\Generated\WalletAddressServer\Model\JsonWebKeySet|\Psr\Http\Message\ResponseInterface
     */
    public function getWalletAddressKeys(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \OpenPayments\OpenApi\Generated\WalletAddressServer\Endpoint\GetWalletAddressKeys(), $fetch);
    }
    /**
     * @param  string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \OpenPayments\OpenApi\Generated\WalletAddressServer\Exception\GetWalletAddressDidDocumentInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function getWalletAddressDidDocument(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \OpenPayments\OpenApi\Generated\WalletAddressServer\Endpoint\GetWalletAddressDidDocument(), $fetch);
    }
    public static function create($httpClient = null, array $additionalPlugins = [], array $additionalNormalizers = [])
    {
        if (null === $httpClient) {
            $httpClient = \Http\Discovery\Psr18ClientDiscovery::find();
            $plugins = [];
            $uri = \Http\Discovery\Psr17FactoryDiscovery::findUriFactory()->createUri('https://interledger-test.dev/alice');
            $plugins[] = new \Http\Client\Common\Plugin\AddHostPlugin($uri);
            $plugins[] = new \Http\Client\Common\Plugin\AddPathPlugin($uri);
            if (count($additionalPlugins) > 0) {
                $plugins = array_merge($plugins, $additionalPlugins);
            }
            $httpClient = new \Http\Client\Common\PluginClient($httpClient, $plugins);
        }
        $requestFactory = \Http\Discovery\Psr17FactoryDiscovery::findRequestFactory();
        $streamFactory = \Http\Discovery\Psr17FactoryDiscovery::findStreamFactory();
        $normalizers = [new \Symfony\Component\Serializer\Normalizer\ArrayDenormalizer(), new \OpenPayments\OpenApi\Generated\WalletAddressServer\Normalizer\JaneObjectNormalizer()];
        if (count($additionalNormalizers) > 0) {
            $normalizers = array_merge($normalizers, $additionalNormalizers);
        }
        $serializer = new \Symfony\Component\Serializer\Serializer($normalizers, [new \Symfony\Component\Serializer\Encoder\JsonEncoder(new \Symfony\Component\Serializer\Encoder\JsonEncode(), new \Symfony\Component\Serializer\Encoder\JsonDecode(['json_decode_associative' => true]))]);
        return new static($httpClient, $requestFactory, $serializer, $streamFactory);
    }
}
