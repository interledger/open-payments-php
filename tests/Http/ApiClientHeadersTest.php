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

    public function test_signs_a_url_without_a_path_in_the_form_it_is_sent(): void
    {
        $privateKey = sodium_crypto_sign_secretkey(sodium_crypto_sign_keypair());
        $client = new ApiClient(base64_encode($privateKey), 'gnap-key');

        $headers = $client->generateHttpSignature('POST', 'https://auth.example', '{"a":1}', []);

        $jwk = \OpenPayments\Utils\generateJwk('gnap-key', $privateKey);
        $this->assertTrue(\OpenPayments\Utils\validateSignature($jwk, [
            'method' => 'POST',
            'url' => 'https://auth.example/',
            'headers' => array_map('strval', $headers),
            'body' => '{"a":1}',
        ]));
    }

    public function test_signs_a_url_with_the_default_port_in_the_form_it_is_sent(): void
    {
        $privateKey = sodium_crypto_sign_secretkey(sodium_crypto_sign_keypair());
        $client = new ApiClient(base64_encode($privateKey), 'gnap-key');

        $headers = $client->generateHttpSignature('POST', 'https://auth.example:443/gnap', '{"a":1}', []);

        // Guzzle drops the default port, so the server never sees it.
        $jwk = \OpenPayments\Utils\generateJwk('gnap-key', $privateKey);
        $this->assertTrue(\OpenPayments\Utils\validateSignature($jwk, [
            'method' => 'POST',
            'url' => 'https://auth.example/gnap',
            'headers' => array_map('strval', $headers),
            'body' => '{"a":1}',
        ]));
    }

    public function test_signs_a_url_with_a_fragment_in_the_form_it_is_sent(): void
    {
        $privateKey = sodium_crypto_sign_secretkey(sodium_crypto_sign_keypair());
        $client = new ApiClient(base64_encode($privateKey), 'gnap-key');

        $headers = $client->generateHttpSignature('POST', 'https://auth.example/gnap#x', '{"a":1}', []);

        // A fragment is never sent, so the server never sees it.
        $jwk = \OpenPayments\Utils\generateJwk('gnap-key', $privateKey);
        $this->assertTrue(\OpenPayments\Utils\validateSignature($jwk, [
            'method' => 'POST',
            'url' => 'https://auth.example/gnap',
            'headers' => array_map('strval', $headers),
            'body' => '{"a":1}',
        ]));
    }

    public function test_signs_a_url_with_an_uppercase_host_in_the_form_it_is_sent(): void
    {
        $privateKey = sodium_crypto_sign_secretkey(sodium_crypto_sign_keypair());
        $client = new ApiClient(base64_encode($privateKey), 'gnap-key');

        $headers = $client->generateHttpSignature('POST', 'https://Auth.Example/gnap', '{"a":1}', []);

        // Guzzle writes the host in lowercase. The Host header has to say the same, or a
        // server that builds the URL from it checks the signature against another URL.
        $this->assertSame('auth.example', $headers['Host']);
        $jwk = \OpenPayments\Utils\generateJwk('gnap-key', $privateKey);
        $this->assertTrue(\OpenPayments\Utils\validateSignature($jwk, [
            'method' => 'POST',
            'url' => 'https://auth.example/gnap',
            'headers' => array_map('strval', $headers),
            'body' => '{"a":1}',
        ]));
    }

    public function test_writes_a_port_other_than_the_default_into_the_host_header(): void
    {
        $privateKey = sodium_crypto_sign_secretkey(sodium_crypto_sign_keypair());
        $client = new ApiClient(base64_encode($privateKey), 'gnap-key');

        $headers = $client->generateHttpSignature('POST', 'https://d1.localhost:5001/gnap', '{"a":1}', []);

        // Without the port, a server that builds the URL from the Host header checks the
        // signature against https://d1.localhost/gnap.
        $this->assertSame('d1.localhost:5001', $headers['Host']);
    }
}
