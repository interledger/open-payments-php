<?php

namespace OpenPayments\OpenApi\Generated\AuthServer;
use stdClass;
class Client extends \OpenPayments\OpenApi\Generated\AuthServer\Runtime\Client\Client
{
    /**
     * Make a new grant request
     *
     * @param null|\OpenPayments\OpenApi\Generated\AuthServer\Model\PostBody $requestBody 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \OpenPayments\OpenApi\Generated\AuthServer\Exception\PostRequestBadRequestException
     * @throws \OpenPayments\OpenApi\Generated\AuthServer\Exception\PostRequestUnauthorizedException
     * @throws \OpenPayments\OpenApi\Generated\AuthServer\Exception\PostRequestInternalServerErrorException
     *
     * @return null|array|\Psr\Http\Message\ResponseInterface
     */
    public function postRequest(?\OpenPayments\OpenApi\Generated\AuthServer\Model\PostBody $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \OpenPayments\OpenApi\Generated\AuthServer\Endpoint\PostRequest($requestBody), $fetch);
    }
    /**
     * Cancel a grant request or delete a grant client side.
     *
     * @param string $id 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \OpenPayments\OpenApi\Generated\AuthServer\Exception\DeleteContinueBadRequestException
     * @throws \OpenPayments\OpenApi\Generated\AuthServer\Exception\DeleteContinueUnauthorizedException
     * @throws \OpenPayments\OpenApi\Generated\AuthServer\Exception\DeleteContinueNotFoundException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function deleteContinue(string $id, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \OpenPayments\OpenApi\Generated\AuthServer\Endpoint\DeleteContinue($id), $fetch);
    }
    /**
     * Continue a grant request during or after user interaction.
     *
     * @param string $id 
     * @param null|\OpenPayments\OpenApi\Generated\AuthServer\Model\ContinueIdPostBody $requestBody 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \OpenPayments\OpenApi\Generated\AuthServer\Exception\PostContinueBadRequestException
     * @throws \OpenPayments\OpenApi\Generated\AuthServer\Exception\PostContinueUnauthorizedException
     * @throws \OpenPayments\OpenApi\Generated\AuthServer\Exception\PostContinueNotFoundException
     *
     * @return null|array|stdClass|\OpenPayments\OpenApi\Generated\AuthServer\Model\ContinueIdPostResponse200|\Psr\Http\Message\ResponseInterface
     */
    public function postContinue(string $id, ?\OpenPayments\OpenApi\Generated\AuthServer\Model\ContinueIdPostBody $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \OpenPayments\OpenApi\Generated\AuthServer\Endpoint\PostContinue($id, $requestBody), $fetch);
    }
    /**
     * Management endpoint to revoke access token.
     *
     * @param string $id 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \OpenPayments\OpenApi\Generated\AuthServer\Exception\DeleteTokenBadRequestException
     * @throws \OpenPayments\OpenApi\Generated\AuthServer\Exception\DeleteTokenUnauthorizedException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function deleteToken(string $id, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \OpenPayments\OpenApi\Generated\AuthServer\Endpoint\DeleteToken($id), $fetch);
    }
    /**
     * Management endpoint to rotate access token.
     *
     * @param string $id 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \OpenPayments\OpenApi\Generated\AuthServer\Exception\PostTokenBadRequestException
     * @throws \OpenPayments\OpenApi\Generated\AuthServer\Exception\PostTokenUnauthorizedException
     * @throws \OpenPayments\OpenApi\Generated\AuthServer\Exception\PostTokenNotFoundException
     *
     * @return null|array|\OpenPayments\OpenApi\Generated\AuthServer\Model\TokenIdPostResponse200|\Psr\Http\Message\ResponseInterface
     */
    public function postToken(string $id, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \OpenPayments\OpenApi\Generated\AuthServer\Endpoint\PostToken($id), $fetch);
    }
    public static function create($httpClient = null, array $additionalPlugins = [], array $additionalNormalizers = [])
    {
        if (null === $httpClient) {
            $httpClient = \Http\Discovery\Psr18ClientDiscovery::find();
            $plugins = [];
            $uri = \Http\Discovery\Psr17FactoryDiscovery::findUriFactory()->createUri('https://auth.interledger-test.dev');
            $plugins[] = new \Http\Client\Common\Plugin\AddHostPlugin($uri);
            if (count($additionalPlugins) > 0) {
                $plugins = array_merge($plugins, $additionalPlugins);
            }
            $httpClient = new \Http\Client\Common\PluginClient($httpClient, $plugins);
        }
        $requestFactory = \Http\Discovery\Psr17FactoryDiscovery::findRequestFactory();
        $streamFactory = \Http\Discovery\Psr17FactoryDiscovery::findStreamFactory();
        $normalizers = [new \Symfony\Component\Serializer\Normalizer\ArrayDenormalizer(), new \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\JaneObjectNormalizer()];
        if (count($additionalNormalizers) > 0) {
            $normalizers = array_merge($normalizers, $additionalNormalizers);
        }
        $serializer = new \Symfony\Component\Serializer\Serializer($normalizers, [new \Symfony\Component\Serializer\Encoder\JsonEncoder(new \Symfony\Component\Serializer\Encoder\JsonEncode(), new \Symfony\Component\Serializer\Encoder\JsonDecode(['json_decode_associative' => true]))]);
        return new static($httpClient, $requestFactory, $serializer, $streamFactory);
    }
}