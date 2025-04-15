<?php

namespace OpenPayments\Models;

class OutgoingPaymentsList
{
    /**
     * @var PageInfo
     */
    public $pagination;

    /**
     * @var list<OutgoingPayment>
     */
    public $result;

    /**
     * @return PageInfo
     */
    public function __construct(array $data = [])
    {
        $this->pagination = $data['pagination'] ?? '';
        $this->result = $data['result'] ?? '';
    }

    public function toArray()
    {
        return [
            'pagination' => $this->pagination,
            'result' => $this->result,
        ];
    }
}
