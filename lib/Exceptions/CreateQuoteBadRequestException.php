<?php

namespace OpenPayments\Exceptions;

class CreateQuoteBadRequestException extends BadRequestException
{
    /**
     * @var string
     */
    private $response;

    public function __construct(string $response = '')
    {
        parent::__construct('No amount was provided and no amount could be inferred from the receiver.');
        $this->response = $response;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }
}
