<?php

namespace OpenPayments\OpenApi\Generated\ResourceServer\Endpoint;

class CreateIncomingPayment extends \OpenPayments\OpenApi\Generated\ResourceServer\Runtime\Client\BaseEndpoint implements \OpenPayments\OpenApi\Generated\ResourceServer\Runtime\Client\Endpoint
{
    /**
    * A client MUST create an **incoming payment** resource before it is possible to send any payments to the wallet address.
    
    When a client creates an **incoming payment** the receiving Account Servicing Entity generates unique payment details that can be used to address payments to the account and returns these details to the client as properties of the new **incoming payment**. Any payments received using those details are then associated with the **incoming payment**.
    
    All of the input parameters are _optional_.
    
    For example, the client could use the `metadata` property to store an external reference on the **incoming payment** and this can be shared with the account holder to assist with reconciliation.
    
    If `incomingAmount` is specified and the total received using the payment details equals or exceeds the specified `incomingAmount`, then the receiving Account Servicing Entity MUST reject any further payments and set `completed` to `true`.
    
    If an `expiresAt` value is defined, and the current date and time on the receiving Account Servicing Entity's systems exceeds that value, the receiving Account Servicing Entity MUST reject any further payments.
    *
    * @param \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentsPostBody $requestBody 
    * @param array $headerParameters {
    *     @var string $Signature-Input The Signature-Input field is a Dictionary structured field containing the metadata for one or more message signatures generated from components within the HTTP message.  Each member describes a single message signature.  The member's key is the label that uniquely identifies the message signature within the context of the HTTP message.  The member's value is the serialization of the covered components Inner List plus all signature metadata parameters identified by the label.  The following components MUST be included: - "@method" - "@target-uri" - "authorization".  When the message contains a request body, the covered components MUST also include the following: - "content-digest"  The keyid parameter of the signature MUST be set to the kid value of the JWK.      See [ietf-httpbis-message-signatures](https://datatracker.ietf.org/doc/html/draft-ietf-httpbis-message-signatures#section-4.1) for more details.
    *     @var string $Signature The signature generated based on the Signature-Input, using the signing algorithm specified in the "alg" field of the JWK.
    * }
    */
    public function __construct(\OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentsPostBody $requestBody, array $headerParameters = [])
    {
        $this->body = $requestBody;
        $this->headerParameters = $headerParameters;
    }
    use \OpenPayments\OpenApi\Generated\ResourceServer\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'POST';
    }
    public function getUri(): string
    {
        return '/incoming-payments';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentsPostBody) {
            return [['Content-Type' => ['application/json']], $serializer->serialize($this->body, 'json')];
        }
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
     * @throws \OpenPayments\OpenApi\Generated\ResourceServer\Exception\CreateIncomingPaymentUnauthorizedException
     * @throws \OpenPayments\OpenApi\Generated\ResourceServer\Exception\CreateIncomingPaymentForbiddenException
     *
     * @return null|\OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentWithMethods
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (201 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return $serializer->deserialize($body, 'OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentWithMethods', 'json');
        }
        if (401 === $status) {
            throw new \OpenPayments\OpenApi\Generated\ResourceServer\Exception\CreateIncomingPaymentUnauthorizedException($response);
        }
        if (403 === $status) {
            throw new \OpenPayments\OpenApi\Generated\ResourceServer\Exception\CreateIncomingPaymentForbiddenException($response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['GNAP'];
    }
}