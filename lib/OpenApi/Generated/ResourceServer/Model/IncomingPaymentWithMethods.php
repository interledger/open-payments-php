<?php

namespace OpenPayments\OpenApi\Generated\ResourceServer\Model;

class IncomingPaymentWithMethods extends \ArrayObject
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
     * The URL identifying the incoming payment.
     *
     * @var string
     */
    protected $id;
    /**
     * The URL of the wallet address this payment is being made into.
     *
     * @var string
     */
    protected $walletAddress;
    /**
     * Describes whether the incoming payment has completed receiving fund.
     *
     * @var bool
     */
    protected $completed = false;
    /**
     * 
     *
     * @var IncomingPaymentIncomingAmount
     */
    protected $incomingAmount;
    /**
     * 
     *
     * @var IncomingPaymentIncomingAmount
     */
    protected $receivedAmount;
    /**
     * The date and time when payments under this incoming payment will no longer be accepted.
     *
     * @var \DateTime
     */
    protected $expiresAt;
    /**
     * Additional metadata associated with the incoming payment. (Optional)
     *
     * @var array<string, mixed>
     */
    protected $metadata;
    /**
     * The date and time when the incoming payment was created.
     *
     * @var \DateTime
     */
    protected $createdAt;
    /**
     * The date and time when the incoming payment was updated.
     *
     * @var \DateTime
     */
    protected $updatedAt;
    /**
     * The list of payment methods supported by this incoming payment.
     *
     * @var list<IlpPaymentMethod>
     */
    protected $methods;
    /**
     * The URL identifying the incoming payment.
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
    /**
     * The URL identifying the incoming payment.
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
     * The URL of the wallet address this payment is being made into.
     *
     * @return string
     */
    public function getWalletAddress(): string
    {
        return $this->walletAddress;
    }
    /**
     * The URL of the wallet address this payment is being made into.
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
     * Describes whether the incoming payment has completed receiving fund.
     *
     * @return bool
     */
    public function getCompleted(): bool
    {
        return $this->completed;
    }
    /**
     * Describes whether the incoming payment has completed receiving fund.
     *
     * @param bool $completed
     *
     * @return self
     */
    public function setCompleted(bool $completed): self
    {
        $this->initialized['completed'] = true;
        $this->completed = $completed;
        return $this;
    }
    /**
     * 
     *
     * @return IncomingPaymentIncomingAmount
     */
    public function getIncomingAmount(): IncomingPaymentIncomingAmount
    {
        return $this->incomingAmount;
    }
    /**
     * 
     *
     * @param IncomingPaymentIncomingAmount $incomingAmount
     *
     * @return self
     */
    public function setIncomingAmount(IncomingPaymentIncomingAmount $incomingAmount): self
    {
        $this->initialized['incomingAmount'] = true;
        $this->incomingAmount = $incomingAmount;
        return $this;
    }
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
     * The date and time when payments under this incoming payment will no longer be accepted.
     *
     * @return \DateTime
     */
    public function getExpiresAt(): \DateTime
    {
        return $this->expiresAt;
    }
    /**
     * The date and time when payments under this incoming payment will no longer be accepted.
     *
     * @param \DateTime $expiresAt
     *
     * @return self
     */
    public function setExpiresAt(\DateTime $expiresAt): self
    {
        $this->initialized['expiresAt'] = true;
        $this->expiresAt = $expiresAt;
        return $this;
    }
    /**
     * Additional metadata associated with the incoming payment. (Optional)
     *
     * @return array<string, mixed>
     */
    public function getMetadata(): iterable
    {
        return $this->metadata;
    }
    /**
     * Additional metadata associated with the incoming payment. (Optional)
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
     * The date and time when the incoming payment was created.
     *
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
    /**
     * The date and time when the incoming payment was created.
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
     * The date and time when the incoming payment was updated.
     *
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }
    /**
     * The date and time when the incoming payment was updated.
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
    /**
     * The list of payment methods supported by this incoming payment.
     *
     * @return list<IlpPaymentMethod>
     */
    public function getMethods(): array
    {
        return $this->methods;
    }
    /**
     * The list of payment methods supported by this incoming payment.
     *
     * @param list<IlpPaymentMethod> $methods
     *
     * @return self
     */
    public function setMethods(array $methods): self
    {
        $this->initialized['methods'] = true;
        $this->methods = $methods;
        return $this;
    }
}