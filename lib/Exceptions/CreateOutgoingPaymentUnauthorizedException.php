<?php

namespace OpenPayments\Exceptions;

class CreateOutgoingPaymentUnauthorizedException extends UnauthorizedException
{
    /**
     * @var string
     */
    private $response;

    public function __construct(string $response = '')
    {
        parent::__construct('Authorization required');
        $this->response = $response;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }
}
