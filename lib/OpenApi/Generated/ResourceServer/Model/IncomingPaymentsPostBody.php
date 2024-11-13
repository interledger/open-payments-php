<?php

namespace OpenPayments\OpenApi\Generated\ResourceServer\Model;

class IncomingPaymentsPostBody
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
     * URL of a wallet address hosted by a Rafiki instance.
     *
     * @var string
     */
    protected $walletAddress;
    /**
     * 
     *
     * @var IncomingPaymentIncomingAmount
     */
    protected $incomingAmount;
    /**
     * The date and time when payments into the incoming payment must no longer be accepted.
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
     * URL of a wallet address hosted by a Rafiki instance.
     *
     * @return string
     */
    public function getWalletAddress(): string
    {
        return $this->walletAddress;
    }
    /**
     * URL of a wallet address hosted by a Rafiki instance.
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
     * The date and time when payments into the incoming payment must no longer be accepted.
     *
     * @return \DateTime
     */
    public function getExpiresAt(): \DateTime
    {
        return $this->expiresAt;
    }
    /**
     * The date and time when payments into the incoming payment must no longer be accepted.
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
}