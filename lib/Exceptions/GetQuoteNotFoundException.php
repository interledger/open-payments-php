<?php

namespace OpenPayments\Exceptions;

class GetQuoteNotFoundException extends NotFoundException
{
    /**
     * @var string
     */
    private $response;

    public function __construct(string $response = '')
    {
        parent::__construct('Quote Not Found');
        $this->response = $response;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }
}
