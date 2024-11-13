<?php

namespace OpenPayments\OpenApi\Generated\ResourceServer\Model;

class PublicIncomingPayment extends \ArrayObject
{
    /**
     * @var array
     */
    protected $initialized = [];
    public function isInitialized($property): bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
     * 
     *
     * @var IncomingPaymentIncomingAmount
     */
    protected $receivedAmount;
    /**
     * The URL of the authorization server endpoint for getting grants and access tokens for this wallet address.
     *
     * @var string
     */
    protected $authServer;
    /**
     * 
     *
     * @return IncomingPaymentIncomingAmount
     */
    public function getReceivedAmount(): IncomingPaymentIncomingAmount
    {
        return $this->receivedAmount;
    }
    /**
     * 
     *
     * @param IncomingPaymentIncomingAmount $receivedAmount
     *
     * @return self
     */
    public function setReceivedAmount(IncomingPaymentIncomingAmount $receivedAmount): self
    {
        $this->initialized['receivedAmount'] = true;
        $this->receivedAmount = $receivedAmount;
        return $this;
    }
    /**
     * The URL of the authorization server endpoint for getting grants and access tokens for this wallet address.
     *
     * @return string
     */
    public function getAuthServer(): string
    {
        return $this->authServer;
    }
    /**
     * The URL of the authorization server endpoint for getting grants and access tokens for this wallet address.
     *
     * @param string $authServer
     *
     * @return self
     */
    public function setAuthServer(string $authServer): self
    {
        $this->initialized['authServer'] = true;
        $this->authServer = $authServer;
        return $this;
    }
}