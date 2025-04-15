<?php

namespace OpenPayments\Exceptions;

class PostRequestInternalServerErrorException extends InternalServerErrorException
{
    /**
     * @var string
     */
    private $response;

    public function __construct(?string $response = null)
    {
        parent::__construct('Internal Server Error');
        $this->response = $response;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }
}
