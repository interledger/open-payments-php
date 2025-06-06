<?php

namespace OpenPayments\Exceptions;

class CompleteIncomingPaymentForbiddenException extends ForbiddenException
{
    /**
     * @var string
     */
    private $response;

    public function __construct(string $response = '')
    {
        parent::__construct('Forbidden');
        $this->response = $response;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }
}
