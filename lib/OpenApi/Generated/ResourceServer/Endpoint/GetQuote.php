<?php

namespace OpenPayments\OpenApi\Generated\ResourceServer\Endpoint;

class GetQuote extends \OpenPayments\OpenApi\Generated\ResourceServer\Runtime\Client\BaseEndpoint implements \OpenPayments\OpenApi\Generated\ResourceServer\Runtime\Client\Endpoint
{
    protected $id;
    /**
     * A client can fetch the latest state of a quote.
     *
     * @param string $id Sub-resource identifier
     * @param array $headerParameters {
     *     @var string $Signature-Input The Signature-Input field is a Dictionary structured field containing the metadata for one or more message signatures generated from components within the HTTP message.  Each member describes a single message signature.  The member's key is the label that uniquely identifies the message signature within the context of the HTTP message.  The member's value is the serialization of the covered components Inner List plus all signature metadata parameters identified by the label.  The following components MUST be included: - "@method" - "@target-uri" - "authorization".  When the message contains a request body, the covered components MUST also include the following: - "content-digest"  The keyid parameter of the signature MUST be set to the kid value of the JWK.      See [ietf-httpbis-message-signatures](https://datatracker.ietf.org/doc/html/draft-ietf-httpbis-message-signatures#section-4.1) for more details.
     *     @var string $Signature The signature generated based on the Signature-Input, using the signing algorithm specified in the "alg" field of the JWK.
     * }
     */
    public function __construct(string $id, array $headerParameters = [])
    {
        $this->id = $id;
        $this->headerParameters = $headerParameters;
    }
    use \OpenPayments\OpenApi\Generated\ResourceServer\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'GET';
    }
    public function getUri(): string
    {
        return str_replace(['{id}'], [$this->id], '/quotes/{id}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    protected function getHeadersOptionsResolver(): \Symfony\Component\OptionsResolver\OptionsResolver
    {
        $optionsResolver = parent::getHeadersOptionsResolver();
        $optionsResolver->setDefined(['Signature-Input', 'Signature']);
        $optionsResolver->setRequired(['Signature-Input', 'Signature']);
        $optionsResolver->setDefaults([]);
        return $optionsResolver;
    }
    /**
     * {@inheritdoc}
     *
     * @throws \OpenPayments\OpenApi\Generated\ResourceServer\Exception\GetQuoteUnauthorizedException
     * @throws \OpenPayments\OpenApi\Generated\ResourceServer\Exception\GetQuoteForbiddenException
     * @throws \OpenPayments\OpenApi\Generated\ResourceServer\Exception\GetQuoteNotFoundException
     *
     * @return null|\OpenPayments\OpenApi\Generated\ResourceServer\Model\Quote
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return json_decode($body, true);//$serializer->deserialize($body, 'OpenPayments\OpenApi\Generated\ResourceServer\Model\Quote', 'json');
        }
        if (401 === $status) {
            throw new \OpenPayments\OpenApi\Generated\ResourceServer\Exception\GetQuoteUnauthorizedException($response);
        }
        if (403 === $status) {
            throw new \OpenPayments\OpenApi\Generated\ResourceServer\Exception\GetQuoteForbiddenException($response);
        }
        if (404 === $status) {
            throw new \OpenPayments\OpenApi\Generated\ResourceServer\Exception\GetQuoteNotFoundException($response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['GNAP'];
    }
}