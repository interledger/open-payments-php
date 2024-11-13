<?php

namespace OpenPayments\OpenApi\Generated\AuthServer\Model;

class PostBodyAccessToken extends \ArrayObject
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
     * A description of the rights associated with this access token.
     *
     * @var list<mixed>
     */
    protected $access;
    /**
     * A description of the rights associated with this access token.
     *
     * @return list<mixed>
     */
    public function getAccess(): array
    {
        return $this->access;
    }
    /**
     * A description of the rights associated with this access token.
     *
     * @param list<mixed> $access
     *
     * @return self
     */
    public function setAccess(array $access): self
    {
        $this->initialized['access'] = true;
        $this->access = $access;
        return $this;
    }
}