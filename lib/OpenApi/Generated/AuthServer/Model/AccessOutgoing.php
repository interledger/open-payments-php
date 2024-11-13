<?php

namespace OpenPayments\OpenApi\Generated\AuthServer\Model;

class AccessOutgoing extends \ArrayObject
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
     * The type of resource request as a string.  This field defines which other fields are allowed in the request object.
     *
     * @var string
     */
    protected $type;
    /**
     * The types of actions the client instance will take at the RS as an array of strings.
     *
     * @var list<string>
     */
    protected $actions;
    /**
     * A string identifier indicating a specific resource at the RS.
     *
     * @var string
     */
    protected $identifier;
    /**
     * Open Payments specific property that defines the limits under which outgoing payments can be created.
     *
     * @var LimitsOutgoing
     */
    protected $limits;
    /**
     * The type of resource request as a string.  This field defines which other fields are allowed in the request object.
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
    /**
     * The type of resource request as a string.  This field defines which other fields are allowed in the request object.
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
     * The types of actions the client instance will take at the RS as an array of strings.
     *
     * @return list<string>
     */
    public function getActions(): array
    {
        return $this->actions;
    }
    /**
     * The types of actions the client instance will take at the RS as an array of strings.
     *
     * @param list<string> $actions
     *
     * @return self
     */
    public function setActions(array $actions): self
    {
        $this->initialized['actions'] = true;
        $this->actions = $actions;
        return $this;
    }
    /**
     * A string identifier indicating a specific resource at the RS.
     *
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }
    /**
     * A string identifier indicating a specific resource at the RS.
     *
     * @param string $identifier
     *
     * @return self
     */
    public function setIdentifier(string $identifier): self
    {
        $this->initialized['identifier'] = true;
        $this->identifier = $identifier;
        return $this;
    }
    /**
     * Open Payments specific property that defines the limits under which outgoing payments can be created.
     *
     * @return LimitsOutgoing
     */
    public function getLimits(): LimitsOutgoing
    {
        return $this->limits;
    }
    /**
     * Open Payments specific property that defines the limits under which outgoing payments can be created.
     *
     * @param LimitsOutgoing $limits
     *
     * @return self
     */
    public function setLimits(LimitsOutgoing $limits): self
    {
        $this->initialized['limits'] = true;
        $this->limits = $limits;
        return $this;
    }
}