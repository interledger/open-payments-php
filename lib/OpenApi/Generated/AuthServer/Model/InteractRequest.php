<?php

namespace OpenPayments\OpenApi\Generated\AuthServer\Model;

class InteractRequest extends \ArrayObject
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
     * Indicates how the client instance can start an interaction.
     *
     * @var list<string>
     */
    protected $start;
    /**
     * Indicates how the client instance can receive an indication that interaction has finished at the AS.
     *
     * @var InteractRequestFinish
     */
    protected $finish;
    /**
     * Indicates how the client instance can start an interaction.
     *
     * @return list<string>
     */
    public function getStart(): array
    {
        return $this->start;
    }
    /**
     * Indicates how the client instance can start an interaction.
     *
     * @param list<string> $start
     *
     * @return self
     */
    public function setStart(array $start): self
    {
        $this->initialized['start'] = true;
        $this->start = $start;
        return $this;
    }
    /**
     * Indicates how the client instance can receive an indication that interaction has finished at the AS.
     *
     * @return InteractRequestFinish
     */
    public function getFinish(): InteractRequestFinish
    {
        return $this->finish;
    }
    /**
     * Indicates how the client instance can receive an indication that interaction has finished at the AS.
     *
     * @param InteractRequestFinish $finish
     *
     * @return self
     */
    public function setFinish(InteractRequestFinish $finish): self
    {
        $this->initialized['finish'] = true;
        $this->finish = $finish;
        return $this;
    }

    public function toArray(): array
    {
        return array_filter([
            'start' => $this->start,
            'finish' => $this->finish->toArray(),
        ]);
    }
}