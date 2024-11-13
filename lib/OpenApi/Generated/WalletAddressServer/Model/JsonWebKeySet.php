<?php

namespace OpenPayments\OpenApi\Generated\WalletAddressServer\Model;

class JsonWebKeySet
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
     * @var list<JsonWebKey>
     */
    protected $keys;
    /**
     *
     *
     * @return list<JsonWebKey>
     */
    public function getKeys(): array
    {
        return $this->keys;
    }
    /**
     *
     *
     * @param list<JsonWebKey> $keys
     *
     * @return self
     */
    public function setKeys(array $keys): self
    {
        $this->initialized['keys'] = true;
        $this->keys = $keys;
        return $this;
    }
}
