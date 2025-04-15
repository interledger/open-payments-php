<?php

namespace OpenPayments\Exceptions;

class GetOutgoingPaymentNotFoundException extends NotFoundException
{
    /**
     * @var string
     */
    private $response;

    public function __construct(string $response = '')
    {
        parent::__construct($response, 404);
        $this->response = $response;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }
}
