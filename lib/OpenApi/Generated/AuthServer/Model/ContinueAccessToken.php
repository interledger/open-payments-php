<?php

namespace OpenPayments\OpenApi\Generated\AuthServer\Model;

class ContinueAccessToken extends \ArrayObject
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
     * @var string
     */
    protected $value;
    /**
     * 
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
    /**
     * 
     *
     * @param string $value
     *
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->initialized['value'] = true;
        $this->value = $value;
        return $this;
    }
    public function toArray()
    {
        return [
            'value' => $this->value
        ];
    }
}