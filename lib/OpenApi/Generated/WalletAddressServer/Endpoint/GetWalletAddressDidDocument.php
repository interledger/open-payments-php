<?php

namespace OpenPayments\OpenApi\Generated\WalletAddressServer\Endpoint;

class GetWalletAddressDidDocument extends \OpenPayments\OpenApi\Generated\WalletAddressServer\Runtime\Client\BaseEndpoint implements \OpenPayments\OpenApi\Generated\WalletAddressServer\Runtime\Client\Endpoint
{
    use \OpenPayments\OpenApi\Generated\WalletAddressServer\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'GET';
    }
    public function getUri(): string
    {
        return '/did.json';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    /**
     * {@inheritdoc}
     *
     * @throws \OpenPayments\OpenApi\Generated\WalletAddressServer\Exception\GetWalletAddressDidDocumentInternalServerErrorException
     *
     * @return null
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return json_decode($body);
        }
        if (500 === $status) {
            throw new \OpenPayments\OpenApi\Generated\WalletAddressServer\Exception\GetWalletAddressDidDocumentInternalServerErrorException($response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return [];
    }
}
