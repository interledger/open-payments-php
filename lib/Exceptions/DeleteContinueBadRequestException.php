<?php

namespace OpenPayments\Exceptions;

class DeleteContinueBadRequestException extends BadRequestException
{
    /**
     * @var string
     */
    private $response;

    public function __construct(string $response = '')
    {
        parent::__construct('Bad Request', 400);
        $this->response = $response;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }
}
