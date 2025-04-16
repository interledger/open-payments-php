<?php

namespace OpenPayments\DTO;

use Psr\Log\LoggerInterface;

class CreateUnauthenticatedClientArgs
{
    public ?int $requestTimeoutMs;

    public ?LoggerInterface $logger;

    public ?string $logLevel;

    public bool $useHttp;

    public bool $validateResponses;

    public function __construct(
        ?int $requestTimeoutMs = null,
        ?LoggerInterface $logger = null,
        ?string $logLevel = null,
        bool $useHttp = false,
        bool $validateResponses = true
    ) {
        $this->requestTimeoutMs = $requestTimeoutMs;
        $this->logger = $logger;
        $this->logLevel = $logLevel;
        $this->useHttp = $useHttp;
        $this->validateResponses = $validateResponses;
    }
}
