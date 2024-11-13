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
    interaction by the AS.
    *
    * @var string
    */
    protected $interactRef;
    /**
    * The interaction reference generated for this
    interaction by the AS.
    *
    * @return string
    */
    public function getInteractRef(): string
    {
        return $this->interactRef;
    }
    /**
    * The interaction reference generated for this
    interaction by the AS.
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
}