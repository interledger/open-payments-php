<?php

namespace OpenPayments\Exceptions;

class GetIncomingPaymentNotFoundException extends NotFoundException
{
    /**
     * @var string
     */
    private $response;

    public function __construct(string $response = '')
    {
        parent::__construct('Incoming Payment Not Found');
        $this->response = $response;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }
}
