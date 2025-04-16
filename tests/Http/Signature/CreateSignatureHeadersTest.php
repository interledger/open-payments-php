<?php

use PHPUnit\Framework\TestCase;

class CreateSignatureHeadersTest extends TestCase
{
    public function test_create_signature_headers()
    {
        // Mock request structure
        $request = [
            'method' => 'POST',
            'url' => 'https://example.com/api/resource',
            'headers' => [
                'Authorization' => 'Bearer exampleToken',
            ],
            'body' => '{"key":"value"}',
        ];

        $privateKey = 'your-private-key'; // Use a mock private key
        $keyId = 'exampleKeyId';
        $keyPair = sodium_crypto_sign_keypair();
        $privateKey = sodium_crypto_sign_secretkey($keyPair);
        $publicKey = sodium_crypto_sign_publickey($keyPair);

        // Call the function
        $result = \OpenPayments\Utils\createSignatureHeaders([
            'request' => $request,
            'privateKey' => $privateKey,
            'keyId' => $keyId,
        ]);

        // Assertions
        $this->assertIsArray($result);
        $this->assertArrayHasKey('Signature', $result);
        $this->assertArrayHasKey('Signature-Input', $result);
    }
}
