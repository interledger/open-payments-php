<?php

namespace OpenPayments\OpenApi\Generated\AuthServer\Endpoint;

class PostToken extends \OpenPayments\OpenApi\Generated\AuthServer\Runtime\Client\BaseEndpoint implements \OpenPayments\OpenApi\Generated\AuthServer\Runtime\Client\Endpoint
{
    protected $id;
    /**
     * Management endpoint to rotate access token.
     *
     * @param string $id 
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }
    use \OpenPayments\OpenApi\Generated\AuthServer\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'POST';
    }
    public function getUri(): string
    {
        return str_replace(['{id}'], [$this->id], '/token/{id}');
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
     * @throws \OpenPayments\OpenApi\Generated\AuthServer\Exception\PostTokenBadRequestException
     * @throws \OpenPayments\OpenApi\Generated\AuthServer\Exception\PostTokenUnauthorizedException
     * @throws \OpenPayments\OpenApi\Generated\AuthServer\Exception\PostTokenNotFoundException
     *
     * @return null|\OpenPayments\OpenApi\Generated\AuthServer\Model\TokenIdPostResponse200
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return $serializer->deserialize($body, 'OpenPayments\OpenApi\Generated\AuthServer\Model\TokenIdPostResponse200', 'json');
        }
        if (400 === $status) {
            throw new \OpenPayments\OpenApi\Generated\AuthServer\Exception\PostTokenBadRequestException($response);
        }
        if (401 === $status) {
            throw new \OpenPayments\OpenApi\Generated\AuthServer\Exception\PostTokenUnauthorizedException($response);
        }
        if (404 === $status) {
            throw new \OpenPayments\OpenApi\Generated\AuthServer\Exception\PostTokenNotFoundException($response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['GNAP'];
    }
}