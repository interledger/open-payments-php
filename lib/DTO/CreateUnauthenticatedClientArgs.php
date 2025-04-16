<?php

namespace OpenPayments\DTO;

use Psr\Log\LoggerInterface;

class CreateUnauthenticatedClientArgs
{
    /**
     * @var int|null Milliseconds to wait before timing out an HTTP request
     */
    public ?int $requestTimeoutMs;

    /**
     * @var LoggerInterface|null Custom logger instance
     */
    public ?LoggerInterface $logger;

    /**
     * @var string|null Desired logging level (e.g., 'debug', 'info', 'warn', 'silent')
     */
    public ?string $logLevel;

    /**
     * @var bool Whether to use HTTP as protocol (for development mode only)
     */
    public bool $useHttp;

    /**
     * @var bool Whether to enable or disable response validation (default true)
     */
    public bool $validateResponses;

    /**
     * Constructor to initialize the DTO.
     */
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
