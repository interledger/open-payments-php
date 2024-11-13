<?php

namespace OpenPayments\OpenApi\Generated\ResourceServer\Model;

class OutgoingPayment
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
     * The URL identifying the outgoing payment.
     *
     * @var string
     */
    protected $id;
    /**
     * The URL of the wallet address from which this payment is sent.
     *
     * @var string
     */
    protected $walletAddress;
    /**
     * The URL of the quote defining this payment's amounts.
     *
     * @var string
     */
    protected $quoteId;
    /**
     * Describes whether the payment failed to send its full amount.
     *
     * @var bool
     */
    protected $failed = false;
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
     * @var IncomingPaymentIncomingAmount
     */
    protected $sentAmount;
    /**
     * Additional metadata associated with the outgoing payment. (Optional)
     *
     * @var array<string, mixed>
     */
    protected $metadata;
    /**
     * The date and time when the outgoing payment was created.
     *
     * @var \DateTime
     */
    protected $createdAt;
    /**
     * The date and time when the outgoing payment was updated.
     *
     * @var \DateTime
     */
    protected $updatedAt;
    /**
     * The URL identifying the outgoing payment.
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
    /**
     * The URL identifying the outgoing payment.
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
     * The URL of the wallet address from which this payment is sent.
     *
     * @return string
     */
    public function getWalletAddress(): string
    {
        return $this->walletAddress;
    }
    /**
     * The URL of the wallet address from which this payment is sent.
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
     * The URL of the quote defining this payment's amounts.
     *
     * @return string
     */
    public function getQuoteId(): string
    {
        return $this->quoteId;
    }
    /**
     * The URL of the quote defining this payment's amounts.
     *
     * @param string $quoteId
     *
     * @return self
     */
    public function setQuoteId(string $quoteId): self
    {
        $this->initialized['quoteId'] = true;
        $this->quoteId = $quoteId;
        return $this;
    }
    /**
     * Describes whether the payment failed to send its full amount.
     *
     * @return bool
     */
    public function getFailed(): bool
    {
        return $this->failed;
    }
    /**
     * Describes whether the payment failed to send its full amount.
     *
     * @param bool $failed
     *
     * @return self
     */
    public function setFailed(bool $failed): self
    {
        $this->initialized['failed'] = true;
        $this->failed = $failed;
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
     * @return IncomingPaymentIncomingAmount
     */
    public function getSentAmount(): IncomingPaymentIncomingAmount
    {
        return $this->sentAmount;
    }
    /**
     * 
     *
     * @param IncomingPaymentIncomingAmount $sentAmount
     *
     * @return self
     */
    public function setSentAmount(IncomingPaymentIncomingAmount $sentAmount): self
    {
        $this->initialized['sentAmount'] = true;
        $this->sentAmount = $sentAmount;
        return $this;
    }
    /**
     * Additional metadata associated with the outgoing payment. (Optional)
     *
     * @return array<string, mixed>
     */
    public function getMetadata(): iterable
    {
        return $this->metadata;
    }
    /**
     * Additional metadata associated with the outgoing payment. (Optional)
     *
     * @param array<string, mixed> $metadata
     *
     * @return self
     */
    public function setMetadata(iterable $metadata): self
    {
        $this->initialized['metadata'] = true;
        $this->metadata = $metadata;
        return $this;
    }
    /**
     * The date and time when the outgoing payment was created.
     *
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
    /**
     * The date and time when the outgoing payment was created.
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
    /**
     * The date and time when the outgoing payment was updated.
     *
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }
    /**
     * The date and time when the outgoing payment was updated.
     *
     * @param \DateTime $updatedAt
     *
     * @return self
     */
    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->initialized['updatedAt'] = true;
        $this->updatedAt = $updatedAt;
        return $this;
    }
}