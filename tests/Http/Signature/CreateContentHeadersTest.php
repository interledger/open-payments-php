<?php

use PHPUnit\Framework\TestCase;

class CreateContentHeadersTest extends TestCase
{
    public function testCreateContentHeaders()
    {
        $body = '{"key":"value"}';

        // Expected headers
        $expectedHeaders = [
            'Content-Digest' => 'sha-512=:' . base64_encode(hash('sha512', $body, true)).':',
            'Content-Length' => strlen($body),
            'Content-Type' => 'application/json'
        ];

        // Call the function
        $result = \OpenPayments\Utils\createContentHeaders($body);

        // Assertions
        $this->assertIsArray($result);
        $this->assertEquals($expectedHeaders, $result);
    }
}
