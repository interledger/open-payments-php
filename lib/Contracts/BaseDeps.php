<?php

namespace OpenPayments\Contracts;

use GuzzleHttp\ClientInterface as HttpClient;
use Psr\Log\LoggerInterface;

interface BaseDeps
{
    public function getHttpClient(): HttpClient;

    public function getLogger(): LoggerInterface;

    public function useHttp(): bool;
}
