<?php

namespace OpenPayments\OpenApi\Generated\AuthServer\Model;

class LimitsOutgoing extends \ArrayObject
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
     * The URL of the incoming payment that is being paid.
     *
     * @var string
     */
    protected $receiver;
    /**
     * 
     *
     * @var LimitsOutgoingDebitAmount
     */
    protected $debitAmount;
    /**
     * 
     *
     * @var LimitsOutgoingDebitAmount
     */
    protected $receiveAmount;
    /**
     * [ISO8601 repeating interval](https://en.wikipedia.org/wiki/ISO_8601#Repeating_intervals)
     *
     * @var string
     */
    protected $interval;
    /**
     * The URL of the incoming payment that is being paid.
     *
     * @return string
     */
    public function getReceiver(): string
    {
        return $this->receiver;
    }
    /**
     * The URL of the incoming payment that is being paid.
     *
     * @param string $receiver
     *
     * @return self
     */
    public function setReceiver(string $receiver): self
    {
        $this->initialized['receiver'] = true;
        $this->receiver = $receiver;
        return $this;
    }
    /**
     * 
     *
     * @return LimitsOutgoingDebitAmount
     */
    public function getDebitAmount(): LimitsOutgoingDebitAmount
    {
        return $this->debitAmount;
    }
    /**
     * 
     *
     * @param LimitsOutgoingDebitAmount $debitAmount
     *
     * @return self
     */
    public function setDebitAmount(LimitsOutgoingDebitAmount $debitAmount): self
    {
        $this->initialized['debitAmount'] = true;
        $this->debitAmount = $debitAmount;
        return $this;
    }
    /**
     * 
     *
     * @return LimitsOutgoingDebitAmount
     */
    public function getReceiveAmount(): LimitsOutgoingDebitAmount
    {
        return $this->receiveAmount;
    }
    /**
     * 
     *
     * @param LimitsOutgoingDebitAmount $receiveAmount
     *
     * @return self
     */
    public function setReceiveAmount(LimitsOutgoingDebitAmount $receiveAmount): self
    {
        $this->initialized['receiveAmount'] = true;
        $this->receiveAmount = $receiveAmount;
        return $this;
    }
    /**
     * [ISO8601 repeating interval](https://en.wikipedia.org/wiki/ISO_8601#Repeating_intervals)
     *
     * @return string
     */
    public function getInterval(): string
    {
        return $this->interval;
    }
    /**
     * [ISO8601 repeating interval](https://en.wikipedia.org/wiki/ISO_8601#Repeating_intervals)
     *
     * @param string $interval
     *
     * @return self
     */
    public function setInterval(string $interval): self
    {
        $this->initialized['interval'] = true;
        $this->interval = $interval;
        return $this;
    }
}