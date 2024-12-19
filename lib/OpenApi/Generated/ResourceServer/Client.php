<?php

namespace OpenPayments\OpenApi\Generated\ResourceServer;

class Client extends \OpenPayments\OpenApi\Generated\ResourceServer\Runtime\Client\Client
{
    /**
     * List all incoming payments on the wallet address
     *
     * @param array $queryParameters {
     *     @var string $wallet-address URL of a wallet address hosted by a Rafiki instance.
     *     @var string $cursor The cursor key to list from.
     *     @var int $first The number of items to return after the cursor.
     *     @var int $last The number of items to return before the cursor.
     * }
     * @param array $headerParameters {
     *     @var string $Signature-Input The Signature-Input field is a Dictionary structured field containing the metadata for one or more message signatures generated from components within the HTTP message.  Each member describes a single message signature.  The member's key is the label that uniquely identifies the message signature within the context of the HTTP message.  The member's value is the serialization of the covered components Inner List plus all signature metadata parameters identified by the label.  The following components MUST be included: - "@method" - "@target-uri" - "authorization".  When the message contains a request body, the covered components MUST also include the following: - "content-digest"  The keyid parameter of the signature MUST be set to the kid value of the JWK.      See [ietf-httpbis-message-signatures](https://datatracker.ietf.org/doc/html/draft-ietf-httpbis-message-signatures#section-4.1) for more details.
     *     @var string $Signature The signature generated based on the Signature-Input, using the signing algorithm specified in the "alg" field of the JWK.
     * }
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \OpenPayments\OpenApi\Generated\ResourceServer\Exception\ListIncomingPaymentsUnauthorizedException
     * @throws \OpenPayments\OpenApi\Generated\ResourceServer\Exception\ListIncomingPaymentsForbiddenException
     *
     * @return null|\OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentsGetResponse200|\Psr\Http\Message\ResponseInterface
     */
    public function listIncomingPayments(array $queryParameters = [], array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \OpenPayments\OpenApi\Generated\ResourceServer\Endpoint\ListIncomingPayments($queryParameters, $headerParameters), $fetch);
    }
    /**
    * A client MUST create an **incoming payment** resource before it is possible to send any payments to the wallet address.
    
    * When a client creates an **incoming payment** the receiving Account Servicing Entity generates unique payment details that can be used to address payments to the account and returns these details to the client as properties of the new **incoming payment**. Any payments received using those details are then associated with the **incoming payment**.
    
    * All of the input parameters are _optional_.

    * For example, the client could use the `metadata` property to store an external reference on the **incoming payment** and this can be shared with the account holder to assist with reconciliation.
    
    * If `incomingAmount` is specified and the total received using the payment details equals or exceeds the specified `incomingAmount`, then the receiving Account Servicing Entity MUST reject any further payments and set `completed` to `true`.
    
    * If an `expiresAt` value is defined, and the current date and time on the receiving Account Servicing Entity's systems exceeds that value, the receiving Account Servicing Entity MUST reject any further payments.
    *
    * @param \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentsPostBody $requestBody 
    * @param array $headerParameters {
    *     @var string $Signature-Input The Signature-Input field is a Dictionary structured field containing the metadata for one or more message signatures generated from components within the HTTP message.  Each member describes a single message signature.  The member's key is the label that uniquely identifies the message signature within the context of the HTTP message.  The member's value is the serialization of the covered components Inner List plus all signature metadata parameters identified by the label.  The following components MUST be included: - "@method" - "@target-uri" - "authorization".  When the message contains a request body, the covered components MUST also include the following: - "content-digest"  The keyid parameter of the signature MUST be set to the kid value of the JWK.      See [ietf-httpbis-message-signatures](https://datatracker.ietf.org/doc/html/draft-ietf-httpbis-message-signatures#section-4.1) for more details.
    *     @var string $Signature The signature generated based on the Signature-Input, using the signing algorithm specified in the "alg" field of the JWK.
    * }
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \OpenPayments\OpenApi\Generated\ResourceServer\Exception\CreateIncomingPaymentUnauthorizedException
    * @throws \OpenPayments\OpenApi\Generated\ResourceServer\Exception\CreateIncomingPaymentForbiddenException
    *
    * @return null|array|\OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentWithMethods|\Psr\Http\Message\ResponseInterface
    */
    public function createIncomingPayment(\OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentsPostBody $requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \OpenPayments\OpenApi\Generated\ResourceServer\Endpoint\CreateIncomingPayment($requestBody, $headerParameters), $fetch);
    }
    /**
     * List all outgoing payments on the wallet address
     *
     * @param array $queryParameters {
     *     @var string $wallet-address URL of a wallet address hosted by a Rafiki instance.
     *     @var string $cursor The cursor key to list from.
     *     @var int $first The number of items to return after the cursor.
     *     @var int $last The number of items to return before the cursor.
     * }
     * @param array $headerParameters {
     *     @var string $Signature-Input The Signature-Input field is a Dictionary structured field containing the metadata for one or more message signatures generated from components within the HTTP message.  Each member describes a single message signature.  The member's key is the label that uniquely identifies the message signature within the context of the HTTP message.  The member's value is the serialization of the covered components Inner List plus all signature metadata parameters identified by the label.  The following components MUST be included: - "@method" - "@target-uri" - "authorization".  When the message contains a request body, the covered components MUST also include the following: - "content-digest"  The keyid parameter of the signature MUST be set to the kid value of the JWK.      See [ietf-httpbis-message-signatures](https://datatracker.ietf.org/doc/html/draft-ietf-httpbis-message-signatures#section-4.1) for more details.
     *     @var string $Signature The signature generated based on the Signature-Input, using the signing algorithm specified in the "alg" field of the JWK.
     * }
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \OpenPayments\OpenApi\Generated\ResourceServer\Exception\ListOutgoingPaymentsUnauthorizedException
     * @throws \OpenPayments\OpenApi\Generated\ResourceServer\Exception\ListOutgoingPaymentsForbiddenException
     *
     * @return null|\OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPaymentsGetResponse200|\Psr\Http\Message\ResponseInterface
     */
    public function listOutgoingPayments(array $queryParameters = [], array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \OpenPayments\OpenApi\Generated\ResourceServer\Endpoint\ListOutgoingPayments($queryParameters, $headerParameters), $fetch);
    }
    /**
    * An **outgoing payment** is a sub-resource of a wallet address. It represents a payment from the wallet address.
    
    * Once created, it is already authorized and SHOULD be processed immediately. If payment fails, the Account Servicing Entity must mark the **outgoing payment** as `failed`.
    *
    * @param mixed $requestBody 
    * @param array $headerParameters {
    *     @var string $Signature-Input The Signature-Input field is a Dictionary structured field containing the metadata for one or more message signatures generated from components within the HTTP message.  Each member describes a single message signature.  The member's key is the label that uniquely identifies the message signature within the context of the HTTP message.  The member's value is the serialization of the covered components Inner List plus all signature metadata parameters identified by the label.  The following components MUST be included: - "@method" - "@target-uri" - "authorization".  When the message contains a request body, the covered components MUST also include the following: - "content-digest"  The keyid parameter of the signature MUST be set to the kid value of the JWK.      See [ietf-httpbis-message-signatures](https://datatracker.ietf.org/doc/html/draft-ietf-httpbis-message-signatures#section-4.1) for more details.
    *     @var string $Signature The signature generated based on the Signature-Input, using the signing algorithm specified in the "alg" field of the JWK.
    * }
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \OpenPayments\OpenApi\Generated\ResourceServer\Exception\CreateOutgoingPaymentUnauthorizedException
    * @throws \OpenPayments\OpenApi\Generated\ResourceServer\Exception\CreateOutgoingPaymentForbiddenException
    *
    * @return null|\OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPaymentWithSpentAmounts|\Psr\Http\Message\ResponseInterface
    */
    public function createOutgoingPayment($requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \OpenPayments\OpenApi\Generated\ResourceServer\Endpoint\CreateOutgoingPayment($requestBody, $headerParameters), $fetch);
    }
    /**
     * A **quote** is a sub-resource of a wallet address. It represents a quote for a payment from the wallet address.
     *
     * @param mixed $requestBody 
     * @param array $headerParameters {
     *     @var string $Signature-Input The Signature-Input field is a Dictionary structured field containing the metadata for one or more message signatures generated from components within the HTTP message.  Each member describes a single message signature.  The member's key is the label that uniquely identifies the message signature within the context of the HTTP message.  The member's value is the serialization of the covered components Inner List plus all signature metadata parameters identified by the label.  The following components MUST be included: - "@method" - "@target-uri" - "authorization".  When the message contains a request body, the covered components MUST also include the following: - "content-digest"  The keyid parameter of the signature MUST be set to the kid value of the JWK.      See [ietf-httpbis-message-signatures](https://datatracker.ietf.org/doc/html/draft-ietf-httpbis-message-signatures#section-4.1) for more details.
     *     @var string $Signature The signature generated based on the Signature-Input, using the signing algorithm specified in the "alg" field of the JWK.
     * }
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \OpenPayments\OpenApi\Generated\ResourceServer\Exception\CreateQuoteBadRequestException
     * @throws \OpenPayments\OpenApi\Generated\ResourceServer\Exception\CreateQuoteUnauthorizedException
     * @throws \OpenPayments\OpenApi\Generated\ResourceServer\Exception\CreateQuoteForbiddenException
     *
     * @return null|\OpenPayments\OpenApi\Generated\ResourceServer\Model\Quote|\Psr\Http\Message\ResponseInterface
     */
    public function createQuote($requestBody, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \OpenPayments\OpenApi\Generated\ResourceServer\Endpoint\CreateQuote($requestBody, $headerParameters), $fetch);
    }
    /**
     * A client can fetch the latest state of an incoming payment to determine the amount received into the wallet address.
     *
     * @param string $id Sub-resource identifier
     * @param array $headerParameters {
     *     @var string $Signature-Input The Signature-Input field is a Dictionary structured field containing the metadata for one or more message signatures generated from components within the HTTP message.  Each member describes a single message signature.  The member's key is the label that uniquely identifies the message signature within the context of the HTTP message.  The member's value is the serialization of the covered components Inner List plus all signature metadata parameters identified by the label.  The following components MUST be included: - "@method" - "@target-uri" - "authorization".  When the message contains a request body, the covered components MUST also include the following: - "content-digest"  The keyid parameter of the signature MUST be set to the kid value of the JWK.      See [ietf-httpbis-message-signatures](https://datatracker.ietf.org/doc/html/draft-ietf-httpbis-message-signatures#section-4.1) for more details.
     *     @var string $Signature The signature generated based on the Signature-Input, using the signing algorithm specified in the "alg" field of the JWK.
     * }
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \OpenPayments\OpenApi\Generated\ResourceServer\Exception\GetIncomingPaymentUnauthorizedException
     * @throws \OpenPayments\OpenApi\Generated\ResourceServer\Exception\GetIncomingPaymentForbiddenException
     * @throws \OpenPayments\OpenApi\Generated\ResourceServer\Exception\GetIncomingPaymentNotFoundException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function getIncomingPayment(string $id, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \OpenPayments\OpenApi\Generated\ResourceServer\Endpoint\GetIncomingPayment($id, $headerParameters), $fetch);
    }
    /**
    * A client with the appropriate permissions MAY mark a non-expired **incoming payment** as `completed` indicating that the client is not going to make any further payments toward this **incoming payment**, even though the full `incomingAmount` may not have been received.
    
    * This indicates to the receiving Account Servicing Entity that it can begin any post processing of the payment such as generating account statements or notifying the account holder of the completed payment.
    *
    * @param string $id Sub-resource identifier
    * @param array $headerParameters {
    *     @var string $Signature-Input The Signature-Input field is a Dictionary structured field containing the metadata for one or more message signatures generated from components within the HTTP message.  Each member describes a single message signature.  The member's key is the label that uniquely identifies the message signature within the context of the HTTP message.  The member's value is the serialization of the covered components Inner List plus all signature metadata parameters identified by the label.  The following components MUST be included: - "@method" - "@target-uri" - "authorization".  When the message contains a request body, the covered components MUST also include the following: - "content-digest"  The keyid parameter of the signature MUST be set to the kid value of the JWK.      See [ietf-httpbis-message-signatures](https://datatracker.ietf.org/doc/html/draft-ietf-httpbis-message-signatures#section-4.1) for more details.
    *     @var string $Signature The signature generated based on the Signature-Input, using the signing algorithm specified in the "alg" field of the JWK.
    * }
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \OpenPayments\OpenApi\Generated\ResourceServer\Exception\CompleteIncomingPaymentUnauthorizedException
    * @throws \OpenPayments\OpenApi\Generated\ResourceServer\Exception\CompleteIncomingPaymentForbiddenException
    * @throws \OpenPayments\OpenApi\Generated\ResourceServer\Exception\CompleteIncomingPaymentNotFoundException
    *
    * @return null|\OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPayment|\Psr\Http\Message\ResponseInterface
    */
    public function completeIncomingPayment(string $id, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \OpenPayments\OpenApi\Generated\ResourceServer\Endpoint\CompleteIncomingPayment($id, $headerParameters), $fetch);
    }
    /**
     * A client can fetch the latest state of an outgoing payment.
     *
     * @param string $id Sub-resource identifier
     * @param array $headerParameters {
     *     @var string $Signature-Input The Signature-Input field is a Dictionary structured field containing the metadata for one or more message signatures generated from components within the HTTP message.  Each member describes a single message signature.  The member's key is the label that uniquely identifies the message signature within the context of the HTTP message.  The member's value is the serialization of the covered components Inner List plus all signature metadata parameters identified by the label.  The following components MUST be included: - "@method" - "@target-uri" - "authorization".  When the message contains a request body, the covered components MUST also include the following: - "content-digest"  The keyid parameter of the signature MUST be set to the kid value of the JWK.      See [ietf-httpbis-message-signatures](https://datatracker.ietf.org/doc/html/draft-ietf-httpbis-message-signatures#section-4.1) for more details.
     *     @var string $Signature The signature generated based on the Signature-Input, using the signing algorithm specified in the "alg" field of the JWK.
     * }
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \OpenPayments\OpenApi\Generated\ResourceServer\Exception\GetOutgoingPaymentUnauthorizedException
     * @throws \OpenPayments\OpenApi\Generated\ResourceServer\Exception\GetOutgoingPaymentForbiddenException
     * @throws \OpenPayments\OpenApi\Generated\ResourceServer\Exception\GetOutgoingPaymentNotFoundException
     *
     * @return null|\OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPayment|\Psr\Http\Message\ResponseInterface
     */
    public function getOutgoingPayment(string $id, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \OpenPayments\OpenApi\Generated\ResourceServer\Endpoint\GetOutgoingPayment($id, $headerParameters), $fetch);
    }
    /**
     * A client can fetch the latest state of a quote.
     *
     * @param string $id Sub-resource identifier
     * @param array $headerParameters {
     *     @var string $Signature-Input The Signature-Input field is a Dictionary structured field containing the metadata for one or more message signatures generated from components within the HTTP message.  Each member describes a single message signature.  The member's key is the label that uniquely identifies the message signature within the context of the HTTP message.  The member's value is the serialization of the covered components Inner List plus all signature metadata parameters identified by the label.  The following components MUST be included: - "@method" - "@target-uri" - "authorization".  When the message contains a request body, the covered components MUST also include the following: - "content-digest"  The keyid parameter of the signature MUST be set to the kid value of the JWK.      See [ietf-httpbis-message-signatures](https://datatracker.ietf.org/doc/html/draft-ietf-httpbis-message-signatures#section-4.1) for more details.
     *     @var string $Signature The signature generated based on the Signature-Input, using the signing algorithm specified in the "alg" field of the JWK.
     * }
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \OpenPayments\OpenApi\Generated\ResourceServer\Exception\GetQuoteUnauthorizedException
     * @throws \OpenPayments\OpenApi\Generated\ResourceServer\Exception\GetQuoteForbiddenException
     * @throws \OpenPayments\OpenApi\Generated\ResourceServer\Exception\GetQuoteNotFoundException
     *
     * @return null|\OpenPayments\OpenApi\Generated\ResourceServer\Model\Quote|\Psr\Http\Message\ResponseInterface
     */
    public function getQuote(string $id, array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \OpenPayments\OpenApi\Generated\ResourceServer\Endpoint\GetQuote($id, $headerParameters), $fetch);
    }
    public static function create($httpClient = null, array $additionalPlugins = [], array $additionalNormalizers = [])
    {
        if (null === $httpClient) {
            $httpClient = \Http\Discovery\Psr18ClientDiscovery::find();
            $plugins = [];
            $uri = \Http\Discovery\Psr17FactoryDiscovery::findUriFactory()->createUri('https://ilp.interledger-test.dev');
            $plugins[] = new \Http\Client\Common\Plugin\AddHostPlugin($uri);
            if (count($additionalPlugins) > 0) {
                $plugins = array_merge($plugins, $additionalPlugins);
            }
            $httpClient = new \Http\Client\Common\PluginClient($httpClient, $plugins);
        }
        $requestFactory = \Http\Discovery\Psr17FactoryDiscovery::findRequestFactory();
        $streamFactory = \Http\Discovery\Psr17FactoryDiscovery::findStreamFactory();
        $normalizers = [new \Symfony\Component\Serializer\Normalizer\ArrayDenormalizer(), new \OpenPayments\OpenApi\Generated\ResourceServer\Normalizer\JaneObjectNormalizer()];
        if (count($additionalNormalizers) > 0) {
            $normalizers = array_merge($normalizers, $additionalNormalizers);
        }
        $serializer = new \Symfony\Component\Serializer\Serializer($normalizers, [new \Symfony\Component\Serializer\Encoder\JsonEncoder(new \Symfony\Component\Serializer\Encoder\JsonEncode(), new \Symfony\Component\Serializer\Encoder\JsonDecode(['json_decode_associative' => true]))]);
        return new static($httpClient, $requestFactory, $serializer, $streamFactory);
    }
}