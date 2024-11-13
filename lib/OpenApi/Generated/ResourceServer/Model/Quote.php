<?php

namespace OpenPayments\OpenApi\Generated\ResourceServer\Model;

class Quote
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
     * The URL identifying the quote.
     *
     * @var string
     */
    protected $id;
    /**
     * The URL of the wallet address from which this quote's payment would be sent.
     *
     * @var string
     */
    protected $walletAddress;
    /**
     * The URL of the incoming payment that is being paid.
     *
     * @var string
     */
    protected $receiver;
    /**
     * 
     *
     * @var IncomingPaymentIncomingAmount
     */
    protected $receiveAmount;
    /**
     * 
     *
     * @var IncomingPaymentIncomingAmount
     */
    protected $debitAmount;
    /**
     * 
     *
     * @var string
     */
    protected $method;
    /**
     * The date and time when the calculated `debitAmount` is no longer valid.
     *
     * @var string
     */
    protected $expiresAt;
    /**
     * The date and time when the quote was created.
     *
     * @var \DateTime
     */
    protected $createdAt;
    /**
     * The URL identifying the quote.
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
    /**
     * The URL identifying the quote.
     *
     * @param string $id
     *
     * @return self
     */
    public function setId(string $id): self
    {
        $this->initialized['id'] = true;
        $this->id = $id;
        return $this;
    }
    /**
     * The URL of the wallet address from which this quote's payment would be sent.
     *
     * @return string
     */
    public function getWalletAddress(): string
    {
        return $this->walletAddress;
    }
    /**
     * The URL of the wallet address from which this quote's payment would be sent.
     *
     * @param string $walletAddress
     *
     * @return self
     */
    public function setWalletAddress(string $walletAddress): self
    {
        $this->initialized['walletAddress'] = true;
        $this->walletAddress = $walletAddress;
        return $this;
    }
    /**
     * The URL of the incoming payment that is being paid.
     *
     * @return string
     */
    public function getReceiver(): string
    {
        return $this->receiver;
    }
    /**
     * The URL of the incoming payment that is being paid.
     *
     * @param string $receiver
     *
     * @return self
     */
    public function setReceiver(string $receiver): self
    {
        $this->initialized['receiver'] = true;
        $this->receiver = $receiver;
        return $this;
    }
    /**
     * 
     *
     * @return IncomingPaymentIncomingAmount
     */
    public function getReceiveAmount(): IncomingPaymentIncomingAmount
    {
        return $this->receiveAmount;
    }
    /**
     * 
     *
     * @param IncomingPaymentIncomingAmount $receiveAmount
     *
     * @return self
     */
    public function setReceiveAmount(IncomingPaymentIncomingAmount $receiveAmount): self
    {
        $this->initialized['receiveAmount'] = true;
        $this->receiveAmount = $receiveAmount;
        return $this;
    }
    /**
     * 
     *
     * @return IncomingPaymentIncomingAmount
     */
    public function getDebitAmount(): IncomingPaymentIncomingAmount
    {
        return $this->debitAmount;
    }
    /**
     * 
     *
     * @param IncomingPaymentIncomingAmount $debitAmount
     *
     * @return self
     */
    public function setDebitAmount(IncomingPaymentIncomingAmount $debitAmount): self
    {
        $this->initialized['debitAmount'] = true;
        $this->debitAmount = $debitAmount;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }
    /**
     * 
     *
     * @param string $method
     *
     * @return self
     */
    public function setMethod(string $method): self
    {
        $this->initialized['method'] = true;
        $this->method = $method;
        return $this;
    }
    /**
     * The date and time when the calculated `debitAmount` is no longer valid.
     *
     * @return string
     */
    public function getExpiresAt(): string
    {
        return $this->expiresAt;
    }
    /**
     * The date and time when the calculated `debitAmount` is no longer valid.
     *
     * @param string $expiresAt
     *
     * @return self
     */
    public function setExpiresAt(string $expiresAt): self
    {
        $this->initialized['expiresAt'] = true;
        $this->expiresAt = $expiresAt;
        return $this;
    }
    /**
     * The date and time when the quote was created.
     *
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
    /**
     * The date and time when the quote was created.
     *
     * @param \DateTime $createdAt
     *
     * @return self
     */
    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->initialized['createdAt'] = true;
        $this->createdAt = $createdAt;
        return $this;
    }
}