<?php

namespace OpenPayments\Services;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;
use Psr\Log\LoggerInterface;
use OpenPayments\Exceptions\ValidationException;

class HttpService
{
    private HttpClient $httpClient;
    private LoggerInterface $logger;

    public function __construct(HttpClient $httpClient, LoggerInterface $logger)
    {
        $this->httpClient = $httpClient;
        $this->logger = $logger;
    }

    public function get(string $url, array $queryParams = [], ?string $accessToken = null, ?callable $responseValidator = null): array
    {
        $urlWithQueryParams = $this->getUrlWithQueryParams($url, $queryParams);

        try {
            $response = $this->httpClient->get($urlWithQueryParams, [
                'headers' => $accessToken ? ['Authorization' => "GNAP $accessToken"] : [],
            ]);

            $responseBody = json_decode($response->getBody()->getContents(), true, JSON_THROW_ON_ERROR);

            if ($responseValidator) {
                $responseValidator([
                    'status' => $response->getStatusCode(),
                    'body' => $responseBody,
                ]);
            }

            return $responseBody;
        } catch (RequestException $e) {
            $this->handleError('GET', $urlWithQueryParams, $e);
        }
    }

    public function post(string $url, array $body = [], ?string $accessToken = null, ?callable $responseValidator = null): array
    {
        try {
            $response = $this->httpClient->post($url, [
                'headers' => array_merge(
                    ['Content-Type' => 'application/json'],
                    $accessToken ? ['Authorization' => "GNAP $accessToken"] : []
                ),
                'json' => $body,
            ]);

            $responseBody = json_decode($response->getBody()->getContents(), true, JSON_THROW_ON_ERROR);

            if ($responseValidator) {
                $responseValidator([
                    'status' => $response->getStatusCode(),
                    'body' => $responseBody,
                ]);
            }

            return $responseBody;
        } catch (RequestException $e) {
            $this->handleError('POST', $url, $e);
        }
    }

    public function delete(string $url, ?string $accessToken = null, ?callable $responseValidator = null): void
    {
        try {
            $response = $this->httpClient->delete($url, [
                'headers' => $accessToken ? ['Authorization' => "GNAP $accessToken"] : [],
            ]);

            if ($responseValidator) {
                $responseValidator([
                    'status' => $response->getStatusCode(),
                    'body' => null,
                ]);
            }
        } catch (RequestException $e) {
            $this->handleError('DELETE', $url, $e);
        }
    }

    private function getUrlWithQueryParams(string $url, array $queryParams): string
    {
        if (empty($queryParams)) {
            return $url;
        }

        $query = http_build_query($queryParams);
        return strpos($url, '?') === false ? "$url?$query" : "$url&$query";
    }

    private function handleError(string $method, string $url, RequestException $exception): void
    {
        $response = $exception->getResponse();
        $status = $response ? $response->getStatusCode() : null;
        $body = $response ? $response->getBody()->getContents() : null;

        $this->logger->error("Error during $method request to $url", [
            'status' => $status,
            'body' => $body,
            'error' => $exception->getMessage(),
        ]);

        throw new ValidationException("Error during $method request to $url", $status, $body);
    }
}
