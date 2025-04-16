<?php

namespace OpenPayments\Exceptions;

class PostContinueUnauthorizedException extends UnauthorizedException
{
    /**
     * @var string
     */
    private $response;

    public function __construct(?string $response = null)
    {
        parent::__construct('Unauthorized');
        $this->response = $response;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }
}
