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
     * @return string
     */
    public function getExpiresAt(): string
    {
        return $this->expiresAt->format("Y-m-d\TH:i:s.v\Z");
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
        return $this->metadata ?? []; // Return an empty array if $metadata is null;
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
     * Customize JSON serialization of this object.
     */
    public function jsonSerialize(): array
    {
        $array = [
            'walletAddress' => $this->walletAddress,
            'incomingAmount' => $this->incomingAmount->toArray() // Assuming PostBodyAccessToken has a toArray() method
        ];
        if ($this->expiresAt !== null) {
            $array['expiresAt'] = $this->expiresAt->format("Y-m-d\TH:i:s.v\Z"); // \DateTime::ATOM Format as ISO 8601
        }
        if (!empty($this->metadata)) { // Only include metadata if it has values
            $array['metadata'] = $this->metadata;
        }
        return $array;
    }
}