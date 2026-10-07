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

    public function test_validate_signature_rejects_tampered_method_url_or_authorization()
    {
        $jwk = \OpenPayments\Utils\generateJwk($this->keyId, $this->privateKey);
        $request = $this->signedRequest('POST', '{"amount":"1"}');

        $tampered = $request;
        $tampered['method'] = 'PUT';
        $this->assertFalse(\OpenPayments\Utils\validateSignature($jwk, $tampered));

        $tampered = $request;
        $tampered['url'] = 'https://example.com/outgoing-payments';
        $this->assertFalse(\OpenPayments\Utils\validateSignature($jwk, $tampered));

        $tampered = $request;
        $tampered['headers']['authorization'] = 'GNAP other-token';
        $this->assertFalse(\OpenPayments\Utils\validateSignature($jwk, $tampered));
    }

    public function test_validate_signature_accepts_byte_sequence_form()
    {
        $jwk = \OpenPayments\Utils\generateJwk($this->keyId, $this->privateKey);
        $request = $this->signedRequest('POST', '{"amount":"1"}');
        $request['headers']['signature'] = 'sig1=:'.substr($request['headers']['signature'], strlen('sig1=')).':';

        $this->assertTrue(\OpenPayments\Utils\validateSignature($jwk, $request));
    }

    public function test_validate_signature_rejects_malformed_signature_wrapper()
    {
        $jwk = \OpenPayments\Utils\generateJwk($this->keyId, $this->privateKey);
        $request = $this->signedRequest('POST', '{"amount":"1"}');
        $value = substr($request['headers']['signature'], strlen('sig1='));

        foreach (["sig1=:$value", "sig1=$value:", "sig1=::$value::", "sig1=sig1=$value", $value, "sig2=:$value:"] as $signature) {
            $request['headers']['signature'] = $signature;
            $this->assertFalse(\OpenPayments\Utils\validateSignature($jwk, $request), $signature);
        }
    }

    public function test_rejects_header_names_that_differ_only_by_case()
    {
        $jwk = \OpenPayments\Utils\generateJwk($this->keyId, $this->privateKey);
        $request = $this->signedRequest('POST', '{"amount":"1"}', lowercase: false);
        $request['headers'] = ['authorization' => 'GNAP other-token'] + $request['headers'];

        $this->assertFalse(\OpenPayments\Utils\validateSignatureHeaders($request));
        $this->assertFalse(\OpenPayments\Utils\validateSignature($jwk, $request));
    }

    public function test_rejects_line_break_in_covered_header()
    {
        $jwk = \OpenPayments\Utils\generateJwk($this->keyId, $this->privateKey);
        $request = $this->signedRequest('GET', null, ['Authorization' => "GNAP token\n\"content-type\": text/plain"]);

        $this->assertFalse(\OpenPayments\Utils\validateSignature($jwk, $request));
    }

    public function test_rejects_signature_input_with_more_than_one_label()
    {
        $request = $this->signedRequest('POST', '{"amount":"1"}');
        $request['headers']['signature-input'] = str_replace('"authorization"', '"authorization"sig1=', $request['headers']['signature-input']);

        $this->assertFalse(\OpenPayments\Utils\validateSignatureHeaders($request));
    }

    public function test_validate_signature_returns_false_for_malformed_request()
    {
        $jwk = \OpenPayments\Utils\generateJwk($this->keyId, $this->privateKey);
        $request = $this->signedRequest('POST', '{"amount":"1"}');

        $noMethod = $request;
        unset($noMethod['method']);
        $this->assertFalse(\OpenPayments\Utils\validateSignature($jwk, $noMethod));

        $noUrl = $request;
        unset($noUrl['url']);
        $this->assertFalse(\OpenPayments\Utils\validateSignature($jwk, $noUrl));

        $arrayHeader = $request;
        $arrayHeader['headers']['authorization'] = ['GNAP token'];
        $this->assertFalse(\OpenPayments\Utils\validateSignature($jwk, $arrayHeader));

        $stringHeaders = $request;
        $stringHeaders['headers'] = 'not-an-array';
        $this->assertFalse(\OpenPayments\Utils\validateSignature($jwk, $stringHeaders));
        $this->assertFalse(\OpenPayments\Utils\validateSignatureHeaders($stringHeaders));
    }

    public function test_create_headers_skips_content_headers_for_empty_body()
    {
        $headers = \OpenPayments\Utils\createHeaders([
            'request' => ['method' => 'POST', 'url' => 'https://example.com/incoming-payments', 'headers' => [], 'body' => ''],
            'privateKey' => $this->privateKey,
            'keyId' => $this->keyId,
        ]);

        $this->assertSame(['Signature', 'Signature-Input'], array_keys($headers));
    }

    public function test_rejects_signature_older_than_max_age()
    {
        $jwk = \OpenPayments\Utils\generateJwk($this->keyId, $this->privateKey);
        $request = $this->signedRequest('POST', '{"amount":"1"}');
        $later = ['now' => time() + 301];

        $this->assertFalse(\OpenPayments\Utils\validateSignatureHeaders($request, $later));
        $this->assertFalse(\OpenPayments\Utils\validateSignature($jwk, $request, $later));
        $this->assertTrue(\OpenPayments\Utils\validateSignature($jwk, $request, ['now' => time() + 301, 'maxAge' => 600]));
    }

    public function test_rejects_signature_created_in_the_future()
    {
        $request = $this->signedRequest('GET', null);

        $this->assertFalse(\OpenPayments\Utils\validateSignatureHeaders($request, ['now' => time() - 61]));
        $this->assertTrue(\OpenPayments\Utils\validateSignatureHeaders($request, ['now' => time() - 30]));
    }

    public function test_rejects_expired_signature()
    {
        $request = $this->signedRequest('GET', null);
        $request['headers']['signature-input'] .= ';expires='.(time() - 1);

        $this->assertFalse(\OpenPayments\Utils\validateSignatureHeaders($request));
    }

    public function test_rejects_signature_input_without_created_or_with_bad_params()
    {
        $request = $this->signedRequest('GET', null);
        $sigInput = $request['headers']['signature-input'];
        $components = substr($sigInput, 0, strpos($sigInput, ')') + 1);

        foreach ([
            $components.';keyid="gnap-key"',
            $components.';keyid="gnap-key";created=abc',
            $components.';keyid="gnap-key";created='.time().';created='.time(),
            $components.';keyid="gnap-key";created='.time()."\n",
            $components.'keyid="gnap-key";created='.time(),
        ] as $value) {
            $request['headers']['signature-input'] = $value;
            $this->assertFalse(\OpenPayments\Utils\validateSignatureHeaders($request), $value);
        }
    }

    public function test_validate_signature_requires_keyid_to_match_jwk_kid()
    {
        $request = $this->signedRequest('POST', '{"amount":"1"}');
        $jwk = \OpenPayments\Utils\generateJwk($this->keyId, $this->privateKey);

        $this->assertFalse(\OpenPayments\Utils\validateSignature(['kid' => 'other-key'] + $jwk, $request));

        $noKid = $jwk;
        unset($noKid['kid']);
        $this->assertFalse(\OpenPayments\Utils\validateSignature($noKid, $request));
    }

    public function test_rejects_body_when_content_type_or_length_is_not_covered()
    {
        $request = $this->signedRequest('POST', '{"amount":"1"}');
        $sigInput = $request['headers']['signature-input'];

        foreach (['"content-type"', '"content-length"'] as $component) {
            $request['headers']['signature-input'] = str_replace(' '.$component, '', $sigInput);
            $this->assertFalse(\OpenPayments\Utils\validateSignatureHeaders($request), $component);
        }
    }

    public function test_signer_reads_header_names_in_any_case()
    {
        $jwk = \OpenPayments\Utils\generateJwk($this->keyId, $this->privateKey);

        $request = $this->signedRequest('POST', '{"amount":"1"}', ['authorization' => 'GNAP token']);
        $this->assertStringContainsString('"authorization"', $request['headers']['signature-input']);
        $this->assertTrue(\OpenPayments\Utils\validateSignature($jwk, $request));

        $request = $this->signedRequest('POST', '{"amount":"1"}', ['AUTHORIZATION' => 'GNAP token', 'content-type' => 'text/plain']);
        $this->assertSame('application/json', $request['headers']['content-type']);
        $this->assertTrue(\OpenPayments\Utils\validateSignature($jwk, $request));
    }

    public function test_signer_rejects_key_id_that_breaks_signature_input()
    {
        foreach (['key"1', 'key\\1', "key\n1"] as $keyId) {
            try {
                \OpenPayments\Utils\createHeaders([
                    'request' => ['method' => 'GET', 'url' => 'https://example.com/incoming-payments', 'headers' => []],
                    'privateKey' => $this->privateKey,
                    'keyId' => $keyId,
                ]);
                $this->fail('Expected exception for key ID '.json_encode($keyId));
            } catch (Exception $e) {
                $this->assertSame('Invalid key ID', $e->getMessage());
            }
        }
    }

    /**
     * Builds a request signed by hand, with the Signature-Input format used by the Node SDK and Rafiki.
     */
    private function handSignedRequest(string $params, string $components = '"@method" "@target-uri" "authorization"'): array
    {
        $request = [
            'method' => 'GET',
            'url' => 'https://example.com/incoming-payments',
            'headers' => ['authorization' => 'GNAP token'],
        ];
        $sigInput = "sig1=($components)$params";
        $base = "\"@method\": GET\n\"@target-uri\": https://example.com/incoming-payments\n\"authorization\": GNAP token\n";
        $base .= '"@signature-params": '.substr($sigInput, strlen('sig1='));
        $request['headers']['signature-input'] = $sigInput;
        $request['headers']['signature'] = 'sig1=:'.base64_encode(sodium_crypto_sign_detached($base, $this->privateKey)).':';

        return $request;
    }

    public function test_accepts_node_style_signature_input()
    {
        $jwk = \OpenPayments\Utils\generateJwk($this->keyId, $this->privateKey);
        $now = time();

        foreach ([
            ";keyid=\"gnap-key\";created=$now",
            ";created=$now;keyid=\"gnap-key\"",
            ";created=$now;keyid=\"gnap-key\";alg=\"ed25519\";nonce=\"abc\";tag=\"gnap\"",
            "; created=$now; keyid=\"gnap-key\"",
            ";keyid=\"gnap-key\";created=$now;expires=".($now + 60),
        ] as $params) {
            $this->assertTrue(\OpenPayments\Utils\validateSignature($jwk, $this->handSignedRequest($params)), $params);
        }
    }

    public function test_validate_signature_rejects_signed_but_expired_input()
    {
        $jwk = \OpenPayments\Utils\generateJwk($this->keyId, $this->privateKey);
        $now = time();

        foreach ([
            ";keyid=\"gnap-key\";created=$now;expires=$now",
            ';keyid="gnap-key";created='.($now - 10).';expires='.($now - 1),
            ';keyid="gnap-key";created='.($now + 30).';expires='.($now + 10),
            ";keyid=\"gnap-key\";created=\"$now\"",
            ";created=$now",
        ] as $params) {
            $this->assertFalse(\OpenPayments\Utils\validateSignature($jwk, $this->handSignedRequest($params)), $params);
        }
    }

    public function test_rejects_components_that_are_not_quoted_names()
    {
        $jwk = \OpenPayments\Utils\generateJwk($this->keyId, $this->privateKey);
        $params = ';keyid="gnap-key";created='.time();

        foreach ([
            '@method @target-uri authorization',
            '"@method" "@target-uri" "authorization";bs',
            '"@method" "@target-uri" "authorization" "x;y"',
            '"@method"  "@target-uri" "authorization"',
        ] as $components) {
            $this->assertFalse(\OpenPayments\Utils\validateSignature($jwk, $this->handSignedRequest($params, $components)), $components);
        }
    }

    public function test_invalid_time_options_throw()
    {
        $request = $this->signedRequest('GET', null);

        foreach ([['maxAge' => 'x'], ['clockSkew' => -1], ['now' => 'abc'], ['maxAge' => false]] as $options) {
            try {
                \OpenPayments\Utils\validateSignatureHeaders($request, $options);
                $this->fail('Expected exception for '.json_encode($options));
            } catch (InvalidArgumentException $e) {
                $this->assertStringContainsString('must be a non-negative integer', $e->getMessage());
            }
        }
    }

    public function test_signer_rejects_header_names_that_differ_only_by_case()
    {
        $this->expectExceptionMessage('Header names must not differ only by case');
        $this->signedRequest('GET', null, ['Authorization' => 'GNAP a', 'authorization' => 'GNAP b']);
    }

    public function test_signer_rejects_non_ascii_key_id()
    {
        $this->expectExceptionMessage('Invalid key ID');
        \OpenPayments\Utils\createHeaders([
            'request' => ['method' => 'GET', 'url' => 'https://example.com/incoming-payments', 'headers' => []],
            'privateKey' => $this->privateKey,
            'keyId' => 'ké',
        ]);
    }
}
