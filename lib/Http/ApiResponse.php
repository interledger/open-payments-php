<?php

declare(strict_types=1);

namespace OpenPayments\Http;

use Psr\Http\Message\ResponseInterface;

class ApiResponse
{
    protected ResponseInterface $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function getBody(): string
    {
        return (string) $this->response->getBody();
    }

    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }
}
