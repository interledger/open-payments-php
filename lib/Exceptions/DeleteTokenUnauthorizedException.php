<?php

namespace OpenPayments\Exceptions;

class DeleteTokenUnauthorizedException extends UnauthorizedException
{
    /**
     * @var string
     */
    private $response;

    public function __construct(string $response = '')
    {
        parent::__construct('Unauthorized');
        $this->response = $response;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }
}
