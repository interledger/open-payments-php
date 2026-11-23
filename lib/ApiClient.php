<?php

declare(strict_types=1);

namespace OpenPayments;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Uri;

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
            $headers = self::mergeHeaders([
                'Content-Length' => strlen($jsonBody),
            ], $headers);
            $options['headers'] = self::mergeHeaders($this->getDefaultHeaders(), $headers);

            if (strtoupper($method) === 'GET' && count($data) > 0) {
                $endpoint = $endpoint.'?'.http_build_query($data);
            }

            // Generate and add HTTP Signature headers
            if ($this->privateKey && $this->keyId && ($method == 'POST' || $this->accessToken)) {
                $signatureHeaders = $this->generateHttpSignature($method, $endpoint, $jsonBody, $options['headers']);
                $options['headers'] = self::mergeHeaders($options['headers'], $signatureHeaders);
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
        // The URL in the form it is sent: Guzzle sends an empty path as "/", drops the
        // default port and never sends a fragment. The server checks the signature
        // against that URL, not the one given here.
        $uri = (new Uri((string) $url))->withFragment('');
        if ($uri->getPath() === '' && $uri->getHost() !== '') {
            $uri = $uri->withPath('/');
        }

        $headers = self::mergeHeaders([], $defaultHeaders);
        if ($this->accessToken) {
            $headers = self::mergeHeaders($headers, ['Authorization' => "GNAP {$this->accessToken}"]);
        }
        $port = $uri->getPort();
        $headers = self::mergeHeaders($headers, ['Host' => $uri->getHost().($port !== null ? ':'.$port : '')]);

        $requestArr = [
            'method' => $method,
            'url' => (string) $uri,
            'headers' => $headers,
            'body' => (string) $jsonBody,
        ];
        $result = \OpenPayments\Utils\createHeaders([
            'request' => $requestArr,
            'privateKey' => base64_decode($this->privateKey),
            'keyId' => $this->keyId,
        ]);

        return self::mergeHeaders($headers, $result);
    }

    /**
     * Merges headers without regard to name case. A value in $override replaces
     * any header in $headers with the same name in another case.
     */
    private static function mergeHeaders(array $headers, array $override): array
    {
        foreach ($override as $name => $value) {
            foreach (array_keys($headers) as $existing) {
                if (strcasecmp((string) $existing, (string) $name) === 0) {
                    unset($headers[$existing]);
                }
            }
            $headers[$name] = $value;
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
