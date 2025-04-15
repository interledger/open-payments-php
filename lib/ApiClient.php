<?php

declare(strict_types=1);

namespace OpenPayments;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ApiClient
{
    private ?string $accessToken = null;

    private string $privateKey;

    private string $keyId;

    public function __construct(string $privateKey = '', string $keyId = '', string $accessToken = '')
    {
        $this->accessToken = $accessToken;
        $this->privateKey = $privateKey;
        $this->keyId = $keyId;

    }

    public function setAccessToken(string $token): void
    {
        $this->accessToken = $token;
    }

    public function request(string $method, string $endpoint, array $data = [], array $headers = []): array
    {
        try {
            $httpClient = new Client(['debug' => false, 'headers' => []]);

            $jsonBody = (! empty($data) && strtoupper($method) !== 'GET')
                ? json_encode($data, JSON_UNESCAPED_SLASHES)
                : '';

            $options = [];
            if (! empty($jsonBody)) {
                $options['body'] = $jsonBody;
            }
            $headers = array_merge([
                'Content-Length' => strlen($jsonBody),
            ], $headers);
            $options['headers'] = array_merge($this->getDefaultHeaders(), $headers);

            if (strtoupper($method) === 'GET' && count($data) > 0) {
                $endpoint = $endpoint.'?'.http_build_query($data);
            }

            // Generate and add HTTP Signature headers
            if ($this->privateKey && $this->keyId && ($method == 'POST' || $this->accessToken)) {
                $signatureHeaders = $this->generateHttpSignature($method, $endpoint, $jsonBody, $options['headers']);
                $options['headers'] = array_merge($options['headers'], $signatureHeaders);
            }

            $response = $httpClient->request($method, $endpoint, $options);

            $contents = $response->getBody()->getContents();
            if ($contents === '') {
                return [
                    'message' => 'No content returned',
                    'status_code' => $response->getStatusCode(),
                ];
            }

            return json_decode($contents, true);
        } catch (RequestException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
                'status_code' => $e->getCode(),
            ];
        }
    }

    public function generateHttpSignature($method, $url, $jsonBody, $defaultHeaders)
    {
        $headers = $defaultHeaders;
        if ($this->accessToken) {
            $headers['Authorization'] = "GNAP {$this->accessToken}";
        }
        $parse = parse_url($url);
        $headers['Host'] = $parse['host'];

        $requestArr = [
            'method' => $method,
            'url' => (string) $url,
            'headers' => $headers,
            'body' => (string) $jsonBody,
        ];
        $result = \OpenPayments\Utils\createHeaders([
            'request' => $requestArr,
            'privateKey' => base64_decode($this->privateKey),
            'keyId' => $this->keyId,
        ]);
        foreach ($result as $key => $value) {
            $headers[$key] = $value;
        }

        return $headers;
    }

    private function getDefaultHeaders(): array
    {
        $headers = [
            'User-Agent' => 'OP-PHP-SDK-Client',
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];

        return $headers;
    }
}
