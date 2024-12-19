<?php

namespace OpenPayments\OpenApi\Generated\AuthServer\Endpoint;

class PostContinue extends \OpenPayments\OpenApi\Generated\AuthServer\Runtime\Client\BaseEndpoint implements \OpenPayments\OpenApi\Generated\AuthServer\Runtime\Client\Endpoint
{
    protected $id;
    /**
     * Continue a grant request during or after user interaction.
     *
     * @param string $id 
     * @param null|\OpenPayments\OpenApi\Generated\AuthServer\Model\ContinueIdPostBody $requestBody 
     */
    public function __construct(string $id, ?\OpenPayments\OpenApi\Generated\AuthServer\Model\ContinueIdPostBody $requestBody = null)
    {
        $this->id = $id;
        $this->body = $requestBody;
    }
    use \OpenPayments\OpenApi\Generated\AuthServer\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'POST';
    }
    public function getUri(): string
    {
        return str_replace(['{id}'], [$this->id], '/continue/{id}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \OpenPayments\OpenApi\Generated\AuthServer\Model\ContinueIdPostBody) {
            $json = json_encode($this->body->jsonSerialize(),JSON_UNESCAPED_SLASHES);//, JSON_PRETTY_PRINT);
            $headers = ['Content-Type' => ['application/json']];
            return [$headers, $json];
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
     * @throws \OpenPayments\OpenApi\Generated\AuthServer\Exception\PostContinueBadRequestException
     * @throws \OpenPayments\OpenApi\Generated\AuthServer\Exception\PostContinueUnauthorizedException
     * @throws \OpenPayments\OpenApi\Generated\AuthServer\Exception\PostContinueNotFoundException
     *
     * @return null|\OpenPayments\OpenApi\Generated\AuthServer\Model\ContinueIdPostResponse200
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return json_decode($body, true);
            //return $serializer->deserialize($body, 'OpenPayments\OpenApi\Generated\AuthServer\Model\ContinueIdPostResponse200', 'json');
        }
        if (400 === $status) {
            throw new \OpenPayments\OpenApi\Generated\AuthServer\Exception\PostContinueBadRequestException($response);
        }
        if (401 === $status) {
            throw new \OpenPayments\OpenApi\Generated\AuthServer\Exception\PostContinueUnauthorizedException($response);
        }
        if (404 === $status) {
            throw new \OpenPayments\OpenApi\Generated\AuthServer\Exception\PostContinueNotFoundException($response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['GNAP'];
    }
}