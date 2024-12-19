<?php

namespace OpenPayments\OpenApi\Generated\AuthServer\Model;

class ContinueIdPostBody extends \ArrayObject
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
    * The interaction reference generated for this
    * interaction by the AS.
    *
    * @var string
    */
    protected $interactRef;
    /**
    * The interaction reference generated for this
    * interaction by the AS.
    *
    * @return string
    */

    public function __construct(array $data = [])
    {
        $this->interactRef = $data['interact_ref'] ?? '';
        $this->initialized = $this->initialized + array_fill_keys(array_keys($data), true);
    }
    public function getInteractRef(): string
    {
        return $this->interactRef;
    }
    /**
    * The interaction reference generated for this
    * interaction by the AS.
    *
    * @param string $interactRef
    *
    * @return self
    */
    public function setInteractRef(string $interactRef): self
    {
        $this->initialized['interactRef'] = true;
        $this->interactRef = $interactRef;
        return $this;
    }
    public function jsonSerialize()
    {
        return [
            'interact_ref' => $this->interactRef
        ];
    }
}