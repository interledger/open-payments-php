<?php

namespace OpenPayments\Exceptions;

class GetOutgoingPaymentGrantUnauthorizedException extends UnauthorizedException
{
    /**
     * @var string
     */
    private $response;

    public function __construct(string $response = '')
    {
        parent::__construct($response);
        $this->response = $response;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }
}
