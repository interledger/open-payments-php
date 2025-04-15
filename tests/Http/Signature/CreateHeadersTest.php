<?php

use PHPUnit\Framework\TestCase;

class CreateHeadersTest extends TestCase
{
    protected $privateKey;

    protected $keyPair;

    protected $keyId;

    protected function setUp(): void
    {
        parent::setUp();

        $this->keyPair = sodium_crypto_sign_keypair();
        $this->privateKey = sodium_crypto_sign_secretkey($this->keyPair);
        $this->keyId = 'exampleKeyId';
    }

    public function test_create_headers_with_body()
    {
        // Mock request structure with a body
        $request = [
            'method' => 'POST',
            'url' => 'https://example.com/api/resource',
            'headers' => [
                'Authorization' => 'Bearer exampleToken',
            ],
            'body' => '{"key":"value"}',
        ];
        // Call the function
        $result = \OpenPayments\Utils\createHeaders([
            'request' => $request,
            'privateKey' => $this->privateKey,
            'keyId' => $this->keyId,
        ]);

        // Assertions
        $this->assertIsArray($result);
        $this->assertArrayHasKey('Content-Digest', $result);
        $this->assertArrayHasKey('Content-Length', $result);
        $this->assertArrayHasKey('Content-Type', $result);
        $this->assertArrayHasKey('Signature', $result);
        $this->assertArrayHasKey('Signature-Input', $result);
    }

    public function test_create_headers_without_body()
    {
        // Mock request structure without a body
        $request = [
            'method' => 'GET',
            'url' => 'https://example.com/api/resource',
            'headers' => [
                'Authorization' => 'Bearer exampleToken',
            ],
        ];

        // Call the function
        $result = \OpenPayments\Utils\createHeaders([
            'request' => $request,
            'privateKey' => $this->privateKey,
            'keyId' => $this->keyId,
        ]);

        // Assertions
        $this->assertIsArray($result);
        $this->assertArrayNotHasKey('Content-Digest', $result);
        $this->assertArrayNotHasKey('Content-Length', $result);
        $this->assertArrayNotHasKey('Content-Type', $result);
        $this->assertArrayHasKey('Signature', $result);
        $this->assertArrayHasKey('Signature-Input', $result);
    }
}
