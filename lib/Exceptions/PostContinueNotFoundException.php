<?php

namespace OpenPayments\Exceptions;

class PostContinueNotFoundException extends NotFoundException
{
    /**
     * @var string
     */
    private $response;

    public function __construct(?string $response = null)
    {
        parent::__construct('Not Found');
        $this->response = $response;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }
}
