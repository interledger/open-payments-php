<?php

namespace OpenPayments\Exceptions;

class DeleteContinueNotFoundException extends NotFoundException
{
    /**
     * @var string
     */
    private $response;

    public function __construct(string $response = '')
    {
        parent::__construct('Not Found', 404);
        $this->response = $response;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }
}
