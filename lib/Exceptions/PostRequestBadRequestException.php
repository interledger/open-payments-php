<?php

namespace OpenPayments\Exceptions;

class PostRequestBadRequestException extends BadRequestException
{
    /**
     * @var string
     */
    private $response;

    public function __construct(?string $response = null)
    {
        parent::__construct('Bad Request');
        $this->response = $response;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }
}
