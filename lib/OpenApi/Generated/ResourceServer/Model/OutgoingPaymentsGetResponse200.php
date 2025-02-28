<?php

namespace OpenPayments\OpenApi\Generated\ResourceServer\Model;

class OutgoingPaymentsGetResponse200 extends \ArrayObject
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
     * @var PageInfo
     */
    protected $pagination;
    /**
     * 
     *
     * @var list<OutgoingPayment>
     */
    protected $result;
    /**
     * 
     *
     * @return PageInfo
     */
    public function getPagination(): PageInfo
    {
        return $this->pagination;
    }
    /**
     * 
     *
     * @param PageInfo $pagination
     *
     * @return self
     */
    public function setPagination(PageInfo $pagination): self
    {
        $this->initialized['pagination'] = true;
        $this->pagination = $pagination;
        return $this;
    }
    /**
     * 
     *
     * @return list<OutgoingPayment>
     */
    public function getResult(): array
    {
        return $this->result;
    }
    /**
     * 
     *
     * @param list<OutgoingPayment> $result
     *
     * @return self
     */
    public function setResult(array $result): self
    {
        $this->initialized['result'] = true;
        $this->result = $result;
        return $this;
    }
    public function toArray()
    {
        return array_filter([
            'pagination' => $this->pagination,
            'result' => $this->result
        ]);
    }
}