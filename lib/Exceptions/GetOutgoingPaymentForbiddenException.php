<?php

namespace OpenPayments\Exceptions;

class GetOutgoingPaymentForbiddenException extends ForbiddenException
{
    /**
     * @var string
     */
    private $response;

    public function __construct(string $response = '')
    {
        parent::__construct($response, 403);
        $this->response = $response;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }
}
