<?php

declare(strict_types=1);

namespace OpenPayments\Http;

use GuzzleHttp\ClientInterface;
use OpenPayments\Exceptions\ApiException;

class ApiRequest
{
    protected ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function send(string $method, string $uri, array $options = [])
    {
        try {
            $response = $this->client->request($method, $uri, $options);
            return new ApiResponse($response);
        } catch (\Exception $e) {
            throw ApiException::fromResponse($e->getMessage());
        }
    }
}
