<?php

namespace OpenPayments\OpenApi\Generated\AuthServer\Endpoint;

class DeleteToken extends \OpenPayments\OpenApi\Generated\AuthServer\Runtime\Client\BaseEndpoint implements \OpenPayments\OpenApi\Generated\AuthServer\Runtime\Client\Endpoint
{
    protected $id;
    /**
     * Management endpoint to revoke access token.
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
        return 'DELETE';
    }
    public function getUri(): string
    {
        return str_replace(['{id}'], [$this->id], '/token/{id}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }
    /**
     * {@inheritdoc}
     *
     * @throws \OpenPayments\OpenApi\Generated\AuthServer\Exception\DeleteTokenBadRequestException
     * @throws \OpenPayments\OpenApi\Generated\AuthServer\Exception\DeleteTokenUnauthorizedException
     *
     * @return null
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (204 === $status) {
            return null;
        }
        if (400 === $status) {
            throw new \OpenPayments\OpenApi\Generated\AuthServer\Exception\DeleteTokenBadRequestException($response);
        }
        if (401 === $status) {
            throw new \OpenPayments\OpenApi\Generated\AuthServer\Exception\DeleteTokenUnauthorizedException($response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['GNAP'];
    }
}