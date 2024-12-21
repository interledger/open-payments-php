<?php

namespace OpenPayments\OpenApi\Generated\AuthServer\Model;

class InteractResponse extends \ArrayObject
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
     * The URI to direct the end user to.
     *
     * @var string
     */
    protected $redirect;
    /**
     * Unique key to secure the callback.
     *
     * @var string
     */
    protected $finish;
    /**
     * The URI to direct the end user to.
     *
     * @return string
     */
    public function getRedirect(): string
    {
        return $this->redirect;
    }
    /**
     * The URI to direct the end user to.
     *
     * @param string $redirect
     *
     * @return self
     */
    public function setRedirect(string $redirect): self
    {
        $this->initialized['redirect'] = true;
        $this->redirect = $redirect;
        return $this;
    }
    /**
     * Unique key to secure the callback.
     *
     * @return string
     */
    public function getFinish(): string
    {
        return $this->finish;
    }
    /**
     * Unique key to secure the callback.
     *
     * @param string $finish
     *
     * @return self
     */
    public function setFinish(string $finish): self
    {
        $this->initialized['finish'] = true;
        $this->finish = $finish;
        return $this;
    }
    public function toArray()
    {
        return [
            'redirect' => $this->redirect,
            'finish' => $this->finish
        ];
    }
}