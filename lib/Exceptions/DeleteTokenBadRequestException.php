<?php

namespace OpenPayments\Exceptions;

class DeleteTokenBadRequestException extends BadRequestException
{
    /**
     * @var string
     */
    private $response;

    public function __construct(string $response = '')
    {
        parent::__construct('Bad Request');
        $this->response = $response;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }
}
