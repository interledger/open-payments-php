<?php

declare(strict_types=1);

namespace OpenPayments\Utils;

use Bakame\Http\StructuredFields\ByteSequence;
use Bakame\Http\StructuredFields\Dictionary;
use Bakame\Http\StructuredFields\Item;
use SodiumException;

/**
 * Generates a JWK (JSON Web Key) for an EdDSA (Ed25519) public key.
 *
 * @param  string  $keyId  A unique identifier for the key.
 * @param  string|null  $providedPrivateKey  An optional private key in binary format; if not provided, a new key pair is generated.
 * @return array The JWK representation of the public key.
 *
 * @throws Exception if the key ID is empty or if the key is not Ed25519.
 */
function generateJwk($keyId, $providedPrivateKey = null): array
{
    if (empty(trim($keyId))) {
        throw new \Exception('KeyId cannot be empty');
    }
    if ($providedPrivateKey) {
        if (! isEd25519Key($providedPrivateKey)) {
            throw new \Exception('Key is not EdDSA-Ed25519');
        }
        $publicKey = sodium_crypto_sign_publickey_from_secretkey($providedPrivateKey);
    } else {
        $keyPair = sodium_crypto_sign_keypair();
        $publicKey = sodium_crypto_sign_publickey($keyPair);
    }

    $x = base64UrlEncode($publicKey);

    return [
        'kid' => $keyId,
        'alg' => 'EdDSA',
        'kty' => 'OKP',
        'crv' => 'Ed25519',
        'x' => $x,
    ];
}

/**
 * base64UrlEncode
 *
 * @param  mixed  $data
 */
function base64UrlEncode(string $data): string
{
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

/**
 * signData
 *
 * @param  mixed  $data
 * @param  mixed  $privateKey
 */
function signData(string $data, string $privateKey): string
{
    $signature = sodium_crypto_sign_detached($data, $privateKey);

    return base64_encode($signature);
}
/**
 * isEd25519Key
 *
 * @param  mixed  $privateKey
 */
function isEd25519Key(string $privateKey): bool
{
    // Ed25519 private keys must be exactly 64 bytes long
    if (strlen($privateKey) !== SODIUM_CRYPTO_SIGN_SECRETKEYBYTES) {
        return false;
    }

    try {
        $publicKey = sodium_crypto_sign_publickey_from_secretkey($privateKey);

        return strlen($publicKey) === SODIUM_CRYPTO_SIGN_PUBLICKEYBYTES;
    } catch (\Exception $e) {
        return false;
    }
}

/**
 * Loads an Ed25519 private key from a specified file.
 *
 * @param  string  $keyFilePath  Path to the private key file.
 * @return string The private key in binary format.
 *
 * @throws Exception if the key file could not be loaded or is invalid.
 */
function loadKey($keyFilePath)
{
    if (! file_exists($keyFilePath)) {
        throw new \Exception("Could not load file: $keyFilePath");
    }

    $fileContent = file_get_contents($keyFilePath);
    $privateKey = sodium_crypto_sign_secretkey($fileContent);

    if (! $privateKey) {
        throw new \Exception('File was loaded, but private key was invalid');
    }

    return $privateKey;
}

/**
 * Generates an Ed25519 private key and optionally saves it in the specified directory.
 *
 * @param  string|null  $dir  Directory to save the key, if desired.
 * @param  string|null  $fileName  File name for the saved key (without extension). If not provided, a timestamp-based name is used.
 * @return string The generated private key in binary format.
 *
 * @throws Exception if the directory cannot be created or if writing the key file fails.
 */
function generateKey($dir = null, $fileName = null)
{
    $keypair = sodium_crypto_sign_keypair();
    $privateKey = sodium_crypto_sign_secretkey($keypair);

    if ($dir) {
        if (! is_dir($dir) && ! mkdir($dir, 0755, true)) {
            throw new \Exception("Could not create directory: $dir");
        }

        $fileName = $fileName ?? 'private-key-'.time();
        $filePath = "$dir/$fileName.pem";

        if (file_put_contents($filePath, $privateKey) === false) {
            throw new \Exception("Could not write key to file: $filePath");
        }
    }

    return $privateKey;
}

/**
 * Loads an Ed25519 private key from a file, or generates and optionally saves a new key if loading fails.
 *
 * @param  string|null  $keyFilePath  Path to the private key file.
 * @param  string|null  $dir  Directory to save the new key if generated.
 * @param  string|null  $fileName  File name for the saved key if generated.
 * @return string The loaded or generated private key in binary format.
 */
function loadOrGenerateKey($keyFilePath = null, $dir = null, $fileName = null)
{
    if ($keyFilePath) {
        try {
            return loadKey($keyFilePath);
        } catch (\Exception $e) {
            // Key could not be loaded; fall back to generating a new one.
        }
    }

    return generateKey($dir, $fileName);
}

/**
 * Loads a Base64-encoded Ed25519 private key.
 *
 * @param  string  $base64Key  The private key in Base64 encoding.
 * @return string|null The private key in binary format, or null if invalid.
 */
function loadBase64Key($base64Key)
{
    $privateKey = base64_decode($base64Key);

    if (sodium_crypto_sign_secretkey($privateKey)) {
        return $privateKey;
    }

    return null;
}

/**
 * @param  array  $options  SignOptions containing the request, private key, and key ID.
 * @return array The SignatureHeaders with 'Signature' and 'Signature-Input'.
 *
 * @throws Exception if signing fails or if required fields are missing.
 */
function createSignatureHeaders(array $options): array
{
    $request = $options['request'];
    $privateKey = $options['privateKey'];
    $keyId = $options['keyId'];

    if (! isset($request['method'], $request['url'], $request['headers']) || empty($keyId)) {
        throw new \Exception('Invalid signing options');
    }

    $components = ['@method', '@target-uri'];
    if (! empty($request['headers']['Authorization']) || ! empty($request['headers']['authorization'])) {
        $components[] = 'authorization';
    }
    if (isset($request['body']) && $request['body'] !== '') {
        $components = array_merge($components, ['content-digest', 'content-length', 'content-type']);
    }

    $signingData = prepareSigningData($request, $components);
    $signatureInput = createSignatureInput($components, $keyId);

    $signingData .= '"@signature-params": '.str_replace('sig1=', '', $signatureInput).'';

    try {
        if (strlen($privateKey) !== SODIUM_CRYPTO_SIGN_SECRETKEYBYTES) {
            $seed = extractSeedFromPem($privateKey);
            $privateKey = construct64BytePrivateKey($seed);
        }

        $signature = signData($signingData, $privateKey);

    } catch (SodiumException $e) {
        throw new \Exception('Signing failed: '.$e->getMessage());
    }

    return [
        'Signature' => "sig1=$signature",
        'Signature-Input' => $signatureInput,
    ];
}

function extractSeedFromPem(string $pemKey): string
{
    // Remove PEM headers and footers
    $pemKey = str_replace(['-----BEGIN PRIVATE KEY-----', '-----END PRIVATE KEY-----', "\n", "\r"], '', $pemKey);

    // Decode the Base64 content
    $keyData = base64_decode($pemKey);
    if ($keyData === false) {
        throw new \InvalidArgumentException('Invalid PEM private key.');
    }
    // PKCS#8 format: Extract the 32-byte private key seed
    $seed = substr($keyData, 16);

    if (strlen($seed) !== 32) {
        throw new \InvalidArgumentException('Invalid key length: Expected 32 bytes for Ed25519 seed.');
    }

    return $seed;
}
/**
 * Prepares the string to be signed based on the components.
 *
 * @param  array  $request  The request data including method, url, headers, and optional body.
 * @param  array  $components  The components to include in the signature.
 * @return string The data to sign.
 */
function prepareSigningData(array $request, array $components): string
{
    $dataToSign = '';

    foreach ($components as $component) {
        switch ($component) {
            case '@method':
                $dataToSign .= '"@method": '.strtoupper($request['method'])."\n";
                break;
            case '@target-uri':
                $dataToSign .= '"@target-uri": '.$request['url']."\n";
                break;
            case 'authorization':
                $authorization = $request['headers']['authorization'] ?? $request['headers']['Authorization'] ?? '';
                $dataToSign .= "\"authorization\": $authorization\n";
                break;
            case 'content-digest':
                $contentDigest = createContentDigestHeader($request['body'], ['sha-512']);
                $dataToSign .= "\"content-digest\": $contentDigest\n";
                break;
            case 'content-length':
                $contentLength = strlen($request['body'] ?? '');
                $dataToSign .= "\"content-length\": $contentLength\n";
                break;
            case 'content-type':
                $contentType = $request['headers']['Content-Type'] ?? 'application/octet-stream';
                $dataToSign .= "\"content-type\": $contentType\n";
                break;
            default:
                throw new \Exception("Unsupported component: $component");
        }
    }

    return $dataToSign;
}

/**
 * Creates the 'Signature-Input' header value.
 *
 * @param  array  $components  The components included in the signature.
 * @param  string  $keyId  The key identifier.
 * @return string The 'Signature-Input' header.
 */
function createSignatureInput(array $components, string $keyId): string
{
    $params = 'keyid="'.$keyId.'";created='.time();

    $fields = implode('" "', $components);

    return 'sig1=("'.$fields.'");'.$params;
}

/**
 * validateSignatureHeaders
 *
 * Checks for the presence of the signature and signature-input headers and verifies they are strings.
 * Extracts components from the signature-input header and validates them.
 *
 * @param  mixed  $request
 */
function validateSignatureHeaders(array $request): bool
{
    $request = normalizeHeaders($request);
    if ($request === null) {
        return false;
    }
    $sig = $request['headers']['signature'] ?? null;
    $sigInput = $request['headers']['signature-input'] ?? null;
    if (! $sig || ! $sigInput || ! is_string($sig) || ! is_string($sigInput)) {
        return false;
    }

    $sigInputComponents = getSigInputComponents($sigInput);

    return $sigInputComponents !== null &&
        validateSigInputComponents($sigInputComponents, $request);
}

/**
 * validateSignature
 *
 * Uses the clientKey JWK to construct a public key, then verifies the signature against the generated challenge.
 * Uses Sodium’s sodium_crypto_sign_verify_detached to validate the signature.
 *
 * @param  mixed  $clientKey
 * @param  mixed  $request
 */
function validateSignature(array $clientKey, array $request): bool
{
    $request = normalizeHeaders($request);
    if ($request === null) {
        return false;
    }
    $sig = $request['headers']['signature'] ?? '';
    $sigInput = $request['headers']['signature-input'] ?? '';

    if (! is_string($sig) || ! is_string($sigInput)) {
        return false;
    }

    $challenge = sigInputToChallenge($sigInput, $request);

    if ($challenge === null) {
        return false;
    }

    $publicKey = publicKeyFromJwk($clientKey);
    // Accept only "sig1=<b64>" and the RFC 9421 byte sequence form "sig1=:<b64>:".
    if (! preg_match('/^sig1=(:?)([A-Za-z0-9+\/]+={0,2})\1$/', $sig, $matches)) {
        return false;
    }
    $signature = base64_decode($matches[2], true);

    if ($publicKey === null || $signature === false || strlen($signature) !== SODIUM_CRYPTO_SIGN_BYTES) {
        return false;
    }

    try {
        return sodium_crypto_sign_verify_detached($signature, $challenge, $publicKey);
    } catch (SodiumException $e) {
        return false;
    }
}

/**
 * Returns the raw Ed25519 public key from a JWK, or null if the JWK is not a valid Ed25519 key.
 */
function publicKeyFromJwk(array $jwk): ?string
{
    if (($jwk['kty'] ?? null) !== 'OKP' || ($jwk['crv'] ?? null) !== 'Ed25519' || ! is_string($jwk['x'] ?? null)) {
        return null;
    }

    try {
        $publicKey = sodium_base642bin($jwk['x'], SODIUM_BASE64_VARIANT_URLSAFE_NO_PADDING);
    } catch (SodiumException $e) {
        return null;
    }

    return strlen($publicKey) === SODIUM_CRYPTO_SIGN_PUBLICKEYBYTES ? $publicKey : null;
}

/**
 * sigInputToChallenge
 *
 * Constructs the challenge string by iterating over each component in the sigInput.
 * Adds @\method, @target-uri, and other headers to the signature base, preparing it for signing.
 *
 * @param  mixed  $sigInput
 * @param  mixed  $request
 */
function sigInputToChallenge(string $sigInput, array $request): ?string
{
    $request = normalizeHeaders($request);
    if ($request === null || ! is_string($request['method'] ?? null) || ! is_string($request['url'] ?? null)) {
        return null;
    }

    $sigInputComponents = getSigInputComponents($sigInput);

    if ($sigInputComponents === null || ! validateSigInputComponents($sigInputComponents, $request)) {
        return null;
    }

    $signatureBase = '';

    foreach ($sigInputComponents as $component) {
        if ($component === '@method') {
            $value = strtoupper($request['method']);
        } elseif ($component === '@target-uri') {
            $value = $request['url'];
        } else {
            $value = $request['headers'][$component] ?? '';
        }

        // A line break in a value could inject extra lines into the signature base.
        if ((! is_string($value) && ! is_int($value)) || preg_match('/[\r\n]/', (string) $value)) {
            return null;
        }

        $signatureBase .= "\"$component\": $value\n";
    }

    $signatureBase .= '"@signature-params": '.substr($sigInput, strlen('sig1='));

    return $signatureBase;
}

/**
 * getSigInputComponents
 *
 * Parses and cleans up the components in signature-input, removing any special characters
 *
 * @param  mixed  $sigInput
 */
function getSigInputComponents(string $sigInput): ?array
{
    // Only a single "sig1" signature is supported.
    if (! str_starts_with($sigInput, 'sig1=') || substr_count($sigInput, 'sig1=') !== 1) {
        return null;
    }

    $messageComponents = explode('sig1=', $sigInput)[1] ?? '';

    $components = explode(';', $messageComponents)[0] ?? '';
    $componentList = explode(' ', $components);

    return $componentList ? array_map(static fn ($component) => trim($component, '()"'), $componentList) : null;
}

/**
 * Lowercases header names so lookups do not depend on the caller's casing.
 * Returns null if headers is not an array or has names that differ only by case,
 * since it is not clear which of those values was signed.
 */
function normalizeHeaders(array $request): ?array
{
    $headers = $request['headers'] ?? [];
    if (! is_array($headers)) {
        return null;
    }

    $request['headers'] = array_change_key_case($headers, CASE_LOWER);

    return count($request['headers']) === count($headers) ? $request : null;
}

/**
 * validateSigInputComponents
 *
 * Ensures that all components are lowercase and validates the presence of necessary headers like content-digest, @method, and @target-uri.
 * Calls verifyContentDigest to validate the content digest if required.
 *
 * @param  mixed  $sigInputComponents
 * @param  mixed  $request
 */
function validateSigInputComponents(array $sigInputComponents, array $request): bool
{
    foreach ($sigInputComponents as $component) {
        if ($component !== strtolower($component)) {
            return false;
        }
    }

    $request = normalizeHeaders($request);
    if ($request === null) {
        return false;
    }
    $body = $request['body'] ?? '';
    $contentDigest = $request['headers']['content-digest'] ?? null;

    if (! is_string($body) || ($contentDigest !== null && ! is_string($contentDigest))) {
        return false;
    }

    // When a body is present, content-digest must be covered and verified.
    if ($body !== '') {
        $isValidContentDigest = in_array('content-digest', $sigInputComponents, true) &&
            isset($contentDigest, $request['headers']['content-length'], $request['headers']['content-type']) &&
            verifyContentDigest($body, $contentDigest);
    } else {
        $isValidContentDigest = ! in_array('content-digest', $sigInputComponents, true) ||
            ($contentDigest !== null && verifyContentDigest($body, $contentDigest));
    }

    return $isValidContentDigest &&
        in_array('@method', $sigInputComponents, true) &&
        in_array('@target-uri', $sigInputComponents, true) &&
        (! isset($request['headers']['authorization']) || in_array('authorization', $sigInputComponents, true));
}

/**
 * verifyContentDigest
 *
 * Verifies a Content-Digest header against a message body.
 *
 * @param  string  $body  The message body.
 * @param  string  $digestHeader  The Content-Digest header value.
 * @return bool True if every digest in the header matches; false if any does not match,
 *              the header is empty or malformed, or it contains an unsupported algorithm.
 */
function verifyContentDigest(string $body, string $digestHeader): bool
{
    try {
        $dictionary = Dictionary::fromHttpValue($digestHeader);

        if (count($dictionary) === 0) {
            return false;
        }

        foreach ($dictionary->getIterator() as $algo => $member) {
            $digest = $member instanceof Item ? $member->value() : null;
            if (! ($digest instanceof ByteSequence)) {
                return false;
            }
            $hash = base64_encode(hash(nodeAlgo($algo), $body, true));

            if (! hash_equals($hash, $digest->encoded())) {
                return false;
            }
        }
    } catch (\InvalidArgumentException $e) {
        return false;
    }

    return true;
}

/**
 * Creates a Content-Digest header for a given message body.
 *
 * @param  string  $body  The message body.
 * @param  array  $algorithms  The digest algorithms to use (e.g., ['sha-256', 'sha-512']).
 * @return string The Content-Digest header value.
 *
 * @throws Exception If an unsupported algorithm is provided.
 */
function createContentDigestHeader(string $body, array $algorithms): string
{
    $digestMap = [];

    foreach ($algorithms as $algo) {
        $hash = hash(nodeAlgo($algo), $body, true);
        $digestMap[$algo] = ByteSequence::fromEncoded(base64_encode($hash));
    }

    $dictionary = Dictionary::fromAssociative($digestMap);

    return $dictionary->toHttpValue();
}

function nodeAlgo(string $algorithm): string
{
    return match ($algorithm) {
        'sha-256' => 'sha256',
        'sha-512' => 'sha512',
        default => throw new \InvalidArgumentException("Unsupported digest algorithm {$algorithm}.")
    };
}

/**
 * Creates content headers based on body data.
 *
 * @param  string  $body  JSON body content.
 * @return array ContentHeaders structure.
 */
function createContentHeaders($body)
{
    return [
        'Content-Digest' => createContentDigestHeader($body, ['sha-512']),
        'Content-Length' => strlen($body),
        'Content-Type' => 'application/json',
    ];
}

/**
 * Combines content headers and signature headers for a request.
 *
 * @param  array  $options  Contains the request, private key, and key ID.
 * @return array The combined headers.
 *
 * @throws Exception if header creation fails.
 */
function createHeaders(array $options): array
{
    $request = $options['request'];
    $privateKey = $options['privateKey'];
    $keyId = $options['keyId'];

    $contentHeaders = isset($request['body']) && $request['body'] !== '' ? createContentHeaders($request['body']) : [];

    if ($contentHeaders) {
        $request['headers'] = array_merge($request['headers'], $contentHeaders);
    }

    $signatureHeaders = createSignatureHeaders([
        'request' => $request,
        'privateKey' => $privateKey,
        'keyId' => $keyId,
    ]);

    return array_merge($contentHeaders, $signatureHeaders);
}

function construct64BytePrivateKey(string $seed): string
{
    if (strlen($seed) !== SODIUM_CRYPTO_SIGN_SEEDBYTES) {
        throw new \InvalidArgumentException('Seed must be 32 bytes.');
    }

    // Generate the keypair from the seed
    $keyPair = sodium_crypto_sign_seed_keypair($seed);

    // Extract the 64-byte private key
    return sodium_crypto_sign_secretkey($keyPair);
}
