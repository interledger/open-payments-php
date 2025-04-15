<?php

namespace OpenPayments\Exceptions;

class GetOutgoingPaymentUnauthorizedException extends UnauthorizedException
{
    /**
     * @var string
     */
    private $response;

    public function __construct(string $response = '')
    {
        parent::__construct($response, 401);
        $this->response = $response;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }
}
