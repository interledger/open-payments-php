<?php

namespace OpenPayments\Exceptions;

class DeleteContinueUnauthorizedException extends UnauthorizedException
{
    /**
     * @var string
     */
    private $response;

    public function __construct(string $response = '')
    {
        parent::__construct('Unauthorized', 401);
        $this->response = $response;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }
}
