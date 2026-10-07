<?php

declare(strict_types=1);

use OpenPayments\ApiClient;
use PHPUnit\Framework\TestCase;

class ApiClientHeadersTest extends TestCase
{
    public function test_signature_headers_replace_caller_headers_with_other_name_case(): void
    {
        $privateKey = sodium_crypto_sign_secretkey(sodium_crypto_sign_keypair());
        $client = new ApiClient(base64_encode($privateKey), 'gnap-key', 'token');

        $headers = $client->generateHttpSignature('POST', 'https://example.com/incoming-payments', '{"a":1}', [
            'authorization' => 'GNAP other',
            'host' => 'other.example.com',
            'content-type' => 'text/plain',
            'Accept' => 'application/json',
        ]);

        $names = array_map('strtolower', array_keys($headers));
        $this->assertSame(count($names), count(array_unique($names)));
        $this->assertSame('GNAP token', $headers['Authorization']);
        $this->assertSame('example.com', $headers['Host']);
        $this->assertSame('application/json', $headers['Content-Type']);

        $jwk = \OpenPayments\Utils\generateJwk('gnap-key', $privateKey);
        $this->assertTrue(\OpenPayments\Utils\validateSignature($jwk, [
            'method' => 'POST',
            'url' => 'https://example.com/incoming-payments',
            'headers' => array_map('strval', $headers),
            'body' => '{"a":1}',
        ]));
    }
}
