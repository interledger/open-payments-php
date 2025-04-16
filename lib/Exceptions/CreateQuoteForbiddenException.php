<?php

namespace OpenPayments\Exceptions;

class CreateQuoteForbiddenException extends ForbiddenException
{
    /**
     * @var string
     */
    private $response;

    public function __construct(string $response = '')
    {
        parent::__construct('Forbidden', 403);
        $this->response = $response;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }
}
