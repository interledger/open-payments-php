<?php

namespace OpenPayments\Models;

class IncomingPaymentsList
{
    /**
     * @var PageInfo
     */
    public $pagination;

    /**
     * @var list<IncomingPayment>
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
