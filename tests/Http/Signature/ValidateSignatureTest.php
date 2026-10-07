<?php

use PHPUnit\Framework\TestCase;

class ValidateSignatureTest extends TestCase
{
    protected $privateKey;

    protected $keyPair;

    protected $keyId;

    protected function setUp(): void
    {
        parent::setUp();

        $this->keyPair = sodium_crypto_sign_keypair();
        $this->privateKey = sodium_crypto_sign_secretkey($this->keyPair);
        $this->keyId = 'gnap-key';
    }

    /**
     * Builds a request signed with createHeaders, the way a client of this library would.
     */
    private function signedRequest(string $method, ?string $body, array $headers = ['Authorization' => 'GNAP token'], bool $lowercase = true): array
    {
        $request = [
            'method' => $method,
            'url' => 'https://example.com/incoming-payments',
            'headers' => $headers,
        ];
        if ($body !== null) {
            $request['body'] = $body;
        }

        $signed = \OpenPayments\Utils\createHeaders([
            'request' => $request,
            'privateKey' => $this->privateKey,
            'keyId' => $this->keyId,
        ]);

        $request['headers'] = array_map('strval', array_merge($headers, $signed));
        if ($lowercase) {
            $request['headers'] = array_change_key_case($request['headers'], CASE_LOWER);
        }

        return $request;
    }

    public function test_round_trip_request_with_body_validates()
    {
        $request = $this->signedRequest('POST', '{"amount":"1"}');

        $this->assertTrue(\OpenPayments\Utils\validateSignatureHeaders($request));
    }

    public function test_round_trip_request_without_body_validates()
    {
        $request = $this->signedRequest('GET', null);

        $this->assertTrue(\OpenPayments\Utils\validateSignatureHeaders($request));
    }

    public function test_round_trip_with_original_header_case_validates()
    {
        $request = $this->signedRequest('POST', '{"amount":"1"}', lowercase: false);

        $this->assertTrue(\OpenPayments\Utils\validateSignatureHeaders($request));
    }

    public function test_body_zero_string_round_trip()
    {
        $request = $this->signedRequest('POST', '0');

        $this->assertStringContainsString('content-digest', $request['headers']['signature-input']);
        $this->assertTrue(\OpenPayments\Utils\validateSignatureHeaders($request));
    }

    public function test_rejects_body_when_content_digest_is_not_covered()
    {
        $request = $this->signedRequest('POST', '{"amount":"1"}', []);
        $request['headers']['signature-input'] = 'sig1=("@method" "@target-uri");keyid="gnap-key";created=1';
        $request['body'] = '{"amount":"999"}';

        $this->assertFalse(\OpenPayments\Utils\validateSignatureHeaders($request));
    }

    public function test_rejects_body_swap_under_stale_digest()
    {
        $request = $this->signedRequest('POST', '{"amount":"1"}');
        $request['body'] = '{"amount":"999"}';

        $this->assertFalse(\OpenPayments\Utils\validateSignatureHeaders($request));
    }

    public function test_non_string_body_returns_false()
    {
        $request = $this->signedRequest('POST', '{"a":1}');
        $request['body'] = ['a' => 1];

        $this->assertFalse(\OpenPayments\Utils\validateSignatureHeaders($request));
    }

    public function test_rejects_uncovered_authorization_with_mixed_case_key()
    {
        $request = $this->signedRequest('GET', null, []);
        $request['headers']['Authorization'] = 'GNAP other-token';

        $this->assertFalse(\OpenPayments\Utils\validateSignatureHeaders($request));
    }

    public function test_verify_content_digest_accepts_matching_digest()
    {
        $header = \OpenPayments\Utils\createContentDigestHeader('x', ['sha-256', 'sha-512']);

        $this->assertTrue(\OpenPayments\Utils\verifyContentDigest('x', $header));
    }

    public function test_verify_content_digest_rejects_empty_header()
    {
        $this->assertFalse(\OpenPayments\Utils\verifyContentDigest('x', ''));
        $this->assertFalse(\OpenPayments\Utils\verifyContentDigest('x', ' '));
    }

    public function test_verify_content_digest_returns_false_for_unsupported_or_malformed_header()
    {
        $this->assertFalse(\OpenPayments\Utils\verifyContentDigest('x', 'sha-1=:AAAA:'));
        $this->assertFalse(\OpenPayments\Utils\verifyContentDigest('x', 'sha-512=notbytes'));
        $this->assertFalse(\OpenPayments\Utils\verifyContentDigest('x', '%%%'));
    }

    public function test_verify_content_digest_requires_all_digests_to_match()
    {
        $good = \OpenPayments\Utils\createContentDigestHeader('x', ['sha-512']);
        $bad = \OpenPayments\Utils\createContentDigestHeader('y', ['sha-256']);

        $this->assertFalse(\OpenPayments\Utils\verifyContentDigest('x', "$good, $bad"));
    }

    public function test_validate_signature_round_trip_with_jwk()
    {
        $jwk = \OpenPayments\Utils\generateJwk($this->keyId, $this->privateKey);

        $this->assertTrue(\OpenPayments\Utils\validateSignature($jwk, $this->signedRequest('POST', '{"amount":"1"}')));
        $this->assertTrue(\OpenPayments\Utils\validateSignature($jwk, $this->signedRequest('GET', null)));
    }

    public function test_validate_signature_rejects_tampered_body()
    {
        $jwk = \OpenPayments\Utils\generateJwk($this->keyId, $this->privateKey);
        $request = $this->signedRequest('POST', '{"amount":"1"}');
        $request['body'] = '{"amount":"999"}';

        $this->assertFalse(\OpenPayments\Utils\validateSignature($jwk, $request));
    }

    public function test_validate_signature_rejects_other_key()
    {
        $jwk = \OpenPayments\Utils\generateJwk($this->keyId);

        $this->assertFalse(\OpenPayments\Utils\validateSignature($jwk, $this->signedRequest('POST', '{"amount":"1"}')));
    }

    public function test_validate_signature_returns_false_for_invalid_input()
    {
        $jwk = \OpenPayments\Utils\generateJwk($this->keyId, $this->privateKey);
        $request = $this->signedRequest('POST', '{"amount":"1"}');

        $badSignature = $request;
        $badSignature['headers']['signature'] = 'sig1=AAAA';
        $this->assertFalse(\OpenPayments\Utils\validateSignature($jwk, $badSignature));

        $this->assertFalse(\OpenPayments\Utils\validateSignature(['kty' => 'OKP', 'crv' => 'Ed25519', 'x' => 'short'], $request));
        $this->assertFalse(\OpenPayments\Utils\validateSignature(['kty' => 'EC', 'crv' => 'P-256', 'x' => $jwk['x']], $request));
    }
}
