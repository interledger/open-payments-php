<?php

use PHPUnit\Framework\TestCase;

class GenerateJwkTest extends TestCase
{
    protected $privateKey;

    protected $keyPair;

    protected $keyId;

    protected function setUp(): void
    {
        // Generate a valid private key
        $this->keyPair = sodium_crypto_sign_keypair();
        $this->privateKey = sodium_crypto_sign_secretkey($this->keyPair);
        $this->keyId = 'exampleTestKeyId';
    }

    /**
     * Test with a valid keyId and auto-generated private key.
     */
    public function test_generate_jwk_with_auto_generated_key()
    {
        // Call the function
        $jwk = \OpenPayments\Utils\generateJwk($this->keyId);

        // Assertions
        $this->assertIsArray($jwk);
        $this->assertArrayHasKey('kid', $jwk);
        $this->assertArrayHasKey('alg', $jwk);
        $this->assertArrayHasKey('kty', $jwk);
        $this->assertArrayHasKey('crv', $jwk);
        $this->assertArrayHasKey('x', $jwk);

        $this->assertEquals($this->keyId, $jwk['kid']);
        $this->assertEquals('EdDSA', $jwk['alg']);
        $this->assertEquals('OKP', $jwk['kty']);
        $this->assertEquals('Ed25519', $jwk['crv']);
        $this->assertNotEmpty($jwk['x']);
    }

    /**
     * Test with a valid keyId and provided private key.
     */
    public function test_generate_jwk_with_provided_private_key()
    {
        // Call the function
        $jwk = \OpenPayments\Utils\generateJwk($this->keyId, $this->privateKey);

        // Assertions
        $this->assertIsArray($jwk);
        $this->assertEquals($this->keyId, $jwk['kid']);
        $this->assertNotEmpty($jwk['x']);
    }

    /**
     * Test with an empty keyId.
     */
    public function test_generate_jwk_with_empty_key_id()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('KeyId cannot be empty');

        // Call the function with an empty keyId
        \OpenPayments\Utils\generateJwk('');
    }

    /**
     * Test with an invalid private key.
     */
    public function test_generate_jwk_with_invalid_private_key()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Key is not EdDSA-Ed25519');

        // Invalid private key (wrong length)
        $invalidPrivateKey = str_repeat('A', 32); // Invalid: not 64 bytes
        $keyId = 'invalidKeyId';

        // Call the function with an invalid private key
        \OpenPayments\Utils\generateJwk($keyId, $invalidPrivateKey);
    }

    /**
     * Test the structure of the generated JWK.
     */
    public function test_jwk_structure()
    {
        // Generate a JWK
        $jwk = \OpenPayments\Utils\generateJwk($this->keyId);

        // Assertions
        $this->assertIsArray($jwk);
        $this->assertEquals('EdDSA', $jwk['alg']);
        $this->assertEquals('OKP', $jwk['kty']);
        $this->assertEquals('Ed25519', $jwk['crv']);
    }
}
