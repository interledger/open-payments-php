<?php

namespace OpenPayments\OpenApi\Generated\ResourceServer\Model;

class IlpPaymentMethod
{
    /**
     * @var array
     */
    protected $initialized = [];

    public function __construct(array $data)
    {
        $this->setType($data['type']);
        $this->setIlpAddress($data['ilpAddress']);
        $this->setSharedSecret($data['sharedSecret']);
    }
    public function isInitialized($property): bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
     * 
     *
     * @var string
     */
    protected $type;
    /**
     * The ILP address to use when establishing a STREAM connection.
     *
     * @var string
     */
    protected $ilpAddress;
    /**
     * The base64 url-encoded shared secret to use when establishing a STREAM connection.
     *
     * @var string
     */
    protected $sharedSecret;
    /**
     * 
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
    /**
     * 
     *
     * @param string $type
     *
     * @return self
     */
    public function setType(string $type): self
    {
        $this->initialized['type'] = true;
        $this->type = $type;
        return $this;
    }
    /**
     * The ILP address to use when establishing a STREAM connection.
     *
     * @return string
     */
    public function getIlpAddress(): string
    {
        return $this->ilpAddress;
    }
    /**
     * The ILP address to use when establishing a STREAM connection.
     *
     * @param string $ilpAddress
     *
     * @return self
     */
    public function setIlpAddress(string $ilpAddress): self
    {
        $this->initialized['ilpAddress'] = true;
        $this->ilpAddress = $ilpAddress;
        return $this;
    }
    /**
     * The base64 url-encoded shared secret to use when establishing a STREAM connection.
     *
     * @return string
     */
    public function getSharedSecret(): string
    {
        return $this->sharedSecret;
    }
    /**
     * The base64 url-encoded shared secret to use when establishing a STREAM connection.
     *
     * @param string $sharedSecret
     *
     * @return self
     */
    public function setSharedSecret(string $sharedSecret): self
    {
        $this->initialized['sharedSecret'] = true;
        $this->sharedSecret = $sharedSecret;
        return $this;
    }

    public function toArray()
    {
        return [
            'type' => $this->type,
            'ilpAddress' => $this->ilpAddress,
            'sharedSecret' => $this->sharedSecret
        ];
    }
}