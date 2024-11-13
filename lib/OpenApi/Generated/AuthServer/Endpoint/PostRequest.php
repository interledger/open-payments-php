<?php

namespace OpenPayments\OpenApi\Generated\AuthServer\Endpoint;

class PostRequest extends \OpenPayments\OpenApi\Generated\AuthServer\Runtime\Client\BaseEndpoint implements \OpenPayments\OpenApi\Generated\AuthServer\Runtime\Client\Endpoint
{
    /**
     * Make a new grant request
     *
     * @param null|\OpenPayments\OpenApi\Generated\AuthServer\Model\PostBody $requestBody 
     */
    public function __construct(?\OpenPayments\OpenApi\Generated\AuthServer\Model\PostBody $requestBody = null)
    {
        $this->body = $requestBody;
    }
    use \OpenPayments\OpenApi\Generated\AuthServer\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'POST';
    }
    public function getUri(): string
    {
        return '/';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \OpenPayments\OpenApi\Generated\AuthServer\Model\PostBody) {
            return [['Content-Type' => ['application/json']], $serializer->serialize($this->body, 'json')];
        }
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    /**
     * {@inheritdoc}
     *
     * @throws \OpenPayments\OpenApi\Generated\AuthServer\Exception\PostRequestBadRequestException
     * @throws \OpenPayments\OpenApi\Generated\AuthServer\Exception\PostRequestUnauthorizedException
     * @throws \OpenPayments\OpenApi\Generated\AuthServer\Exception\PostRequestInternalServerErrorException
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
        if (400 === $status) {
            throw new \OpenPayments\OpenApi\Generated\AuthServer\Exception\PostRequestBadRequestException($response);
        }
        if (401 === $status) {
            throw new \OpenPayments\OpenApi\Generated\AuthServer\Exception\PostRequestUnauthorizedException($response);
        }
        if (500 === $status) {
            throw new \OpenPayments\OpenApi\Generated\AuthServer\Exception\PostRequestInternalServerErrorException($response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['GNAP'];
    }
}