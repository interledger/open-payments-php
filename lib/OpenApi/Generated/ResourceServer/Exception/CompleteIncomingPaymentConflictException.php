<?php

namespace OpenPayments\OpenApi\Generated\ResourceServer\Exception;

class CompleteIncomingPaymentConflictException extends ConflictException implements ClientException
{
    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    private $response;
    public function __construct(\Psr\Http\Message\ResponseInterface $response = null)
    {
        parent::__construct('Incoming Payment Conflict');
        $this->response = $response;
    }
    public function getResponse(): ?\Psr\Http\Message\ResponseInterface
    {
        return $this->response;
    }
}