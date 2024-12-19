<?php

namespace OpenPayments\OpenApi\Generated\Schemas\Model;

class Amount extends \ArrayObject
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
     * The value is an unsigned 64-bit integer amount, represented as a string.
     *
     * @var string
     */
    protected $value;
    /**
     * The assetCode is a code that indicates the underlying asset. This SHOULD be an ISO4217 currency code.
     *
     * @var string
     */
    protected $assetCode;
    /**
     * The scale of amounts denoted in the corresponding asset code.
     *
     * @var int
     */
    protected $assetScale;
    /**
     * The value is an unsigned 64-bit integer amount, represented as a string.
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
    /**
     * The value is an unsigned 64-bit integer amount, represented as a string.
     *
     * @param string $value
     *
     * @return self
     */
    public function setValue(string | int $value): self
    {
        $this->initialized['value'] = true;
        $this->value = "$value";
        return $this;
    }
    /**
     * The assetCode is a code that indicates the underlying asset. This SHOULD be an ISO4217 currency code.
     *
     * @return string
     */
    public function getAssetCode(): string
    {
        return $this->assetCode;
    }
    /**
     * The assetCode is a code that indicates the underlying asset. This SHOULD be an ISO4217 currency code.
     *
     * @param string $assetCode
     *
     * @return self
     */
    public function setAssetCode(string $assetCode): self
    {
        $this->initialized['assetCode'] = true;
        $this->assetCode = $assetCode;
        return $this;
    }
    /**
     * The scale of amounts denoted in the corresponding asset code.
     *
     * @return int
     */
    public function getAssetScale(): int
    {
        return $this->assetScale;
    }
    /**
     * The scale of amounts denoted in the corresponding asset code.
     *
     * @param int $assetScale
     *
     * @return self
     */
    public function setAssetScale(int $assetScale): self
    {
        $this->initialized['assetScale'] = true;
        $this->assetScale = $assetScale;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray(){
        return [
            'value' => $this->value,
            'assetCode' => $this->assetCode,
            'assetScale' => $this->assetScale
        ];
    }
}