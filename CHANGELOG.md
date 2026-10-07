# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.2.0] - 2026-10-07

### Fixed
- `validateSigInputComponents` requires `content-digest` to be covered and verified when the request has a body (#9)
- `verifyContentDigest` threw on every valid `Content-Digest` header; it now verifies the digest. It returns `false` for an empty, malformed or unsupported header instead of throwing
- `validateSignature` threw for every JWK; it now decodes the base64url `x` value. It returns `false` for an invalid key or signature, and accepts the RFC 9421 `sig1=:<b64>:` form
- Signature validators ignore header name case. Before, an uncovered `Authorization` header was not detected
- Signature validators return `false` for a non-string body instead of throwing a `TypeError`
- `createSignatureHeaders` and `createHeaders` now treat the body `"0"` as a body
- `createHeaders` no longer adds unsigned `Content-*` headers for an empty-string body
- Signature validators return `false` for header names that differ only by case, header values with line breaks, a `Signature-Input` with more than one `sig1=`, and a missing or non-string `method` or `url`
- Signature validators check the `created` and `expires` parameters. They return `false` when `created` is missing, older than `maxAge` (default 300 seconds) or more than `clockSkew` (default 60 seconds) in the future, or when `expires` is in the past. This limits replay of old signatures. Pass `['maxAge' => ..., 'clockSkew' => ..., 'now' => ...]` as the last argument to change the limits
- `validateSignature` returns `false` when the `keyid` parameter does not match the JWK `kid`
- Signature validators require `content-length` and `content-type` to be signed when the request has a body. Before, they only had to be present
- The signer reads `Authorization` and `Content-Type` with any name case. Before, it only read `Authorization` or `authorization`, and only `Content-Type`
- `createHeaders` ignores caller `Content-*` headers with other name cases when it signs, so only the generated values are signed
- The signer throws when header names differ only by case, because it is not clear which value to sign
- `ApiClient` merges headers without regard to name case. The `Authorization`, `Host` and signature headers it sets replace caller headers with the same name in another case, so each header is sent once
- `Signature-Input` is read by one strict parser: components must be quoted lowercase names, parameter values must be integers or strings without escapes, and a parameter must not repeat. A signature with `expires` is valid only before `expires`, and `expires` must not be before `created`
- Signature validators throw `InvalidArgumentException` when `maxAge`, `clockSkew` or `now` is not a non-negative integer
- The signer throws for a key ID with a quote, a backslash or a character outside printable ASCII, because it would change the `Signature-Input` header

### Added
- GitHub Actions CI: PHPUnit, PHPStan and Pint
- Grant requests for subject information (spec v1.3 wallet address ownership). A request needs `access_token`, or `interact` and `subject`
- `Subject` and `SubjectId` models. `Grant::$subject` holds the `subject` returned by the auth server
- Grant requests can use a directed identity client: pass `'client' => ['jwk' => ...]` with the public key of the configured key pair. The spec allows this only for non-interactive grants (for example incoming payments), so a request with `jwk` and `interact` fails validation. A `jwk` with a private key (`d`) also fails validation
- The request schema accepts all spec v1.3 `client` forms: wallet address string, `['walletAddress' => ...]` and `['jwk' => ...]`

### Changed
- `Grant::$access_token` is now nullable. It is `null` for a grant that only returns subject information. In that case `Grant::$subject` is set
- `GrantContinue::$access_token` is now `AccessToken|SimpleAccessToken`. It is a `SimpleAccessToken` when the grant has no access token. Only `->value` is set for both types
- These two property types changed, so code that uses static analysis may need a null check or an `instanceof` check
- `GrantService::request()` keeps a caller `client` only when it is a `jwk` object. Any other value is replaced with the configured wallet address, as before. `continue()` always sends the configured wallet address, as before
- `GrantTransformer` throws `UnexpectedValueException` when a grant response has no valid `continue` field, or has neither `access_token` nor `subject` (grant still pending). Before, it threw an `InvalidArgumentException` or a `TypeError`

## [1.1.0] - 2026-06-13

### Added
- `GET /outgoing-payment-grant` endpoint via `OutgoingPaymentService::getGrant()` — returns spent amounts (`spentReceiveAmount`, `spentDebitAmount`) for the current GNAP grant interval ([spec](https://openpayments.dev))
- `OutgoingPaymentGrant` model with nullable `Amount` fields for grant spent amounts
- `GetOutgoingPaymentGrantUnauthorizedException` and `GetOutgoingPaymentGrantForbiddenException` typed exceptions
- `ErrorResponse` model for generic resource server errors (`error`, `message?`)
- `GrantError` model and `GrantErrorCode` enum for auth server structured errors (`invalid_client`, `invalid_request`, `request_denied`, `too_fast`, `invalid_continuation`, `invalid_rotation`)
- `HasErrorResponse` trait — allows any exception to carry a parsed `ErrorResponse` or `GrantError` via `withErrorResponse()` / `withGrantError()` fluent setters
- `OpenPayments\OpenApi\SpecVersion::SPEC_VERSION` constant tracking the upstream spec version (`1.3.2`)
- `Config::getUseHttp(): bool` getter (was stored but never exposed)
- Git submodule `open-payments-specifications` as source of truth for OpenAPI specs

### Changed
- OpenAPI specs synced to `open-payments-specifications` v1.3.2:
  - `auth-server.yaml` upgraded from v1.2 → v1.3.2: adds `grant-request`, `continuation-request`, `subject`, `json-web-key` schemas; structured error schemas (`error-invalid-client`, `error-request-denied`, `error-too-fast`, `error-invalid-continuation`, `error-invalid-rotation`); `client` now supports directed identity (JWK)
  - `resource-server.yaml` adds `GET /outgoing-payment-grant` path
- All DTO and Model properties marked `readonly` (PHP 8.3)
- `const string TYPE` typed constants in ResourceRequest DTOs (PHP 8.3)
- `declare(strict_types=1)` added to all DTO and Model files
- `JsonWebKey` optional fields (`use`, `kty`, `crv`, `x`) made nullable and always initialised in constructor

### Deprecated
- `WalletAddressService::getDIDDocument()` — the DID Document endpoint is no longer part of the upstream Open Payments specification. The method remains available for backwards compatibility, triggers `E_USER_DEPRECATED`, and will be removed in **v1.2.1**.

## [1.0.2] - 2025-10-22

### Changed
- add client automatically to grant request body

### Fixed
- Make Continuation Grant parameter interact_ref optional

## [1.0.1] - 2025-04-16

### Changed
- Code cleanups and improvements

## [1.0.0] - 2025-04-16

### Added
- Initial release of open-payments-php library

[Unreleased]: https://github.com/interledger/open-payments-php/compare/v1.2.0...HEAD
[1.2.0]: https://github.com/interledger/open-payments-php/compare/v1.1.0...v1.2.0
[1.1.0]: https://github.com/interledger/open-payments-php/compare/v1.0.2...v1.1.0
[1.0.2]: https://github.com/interledger/open-payments-php/compare/v1.0.1...v1.0.2
[1.0.1]: https://github.com/interledger/open-payments-php/compare/v1.0.0...v1.0.1
[1.0.0]: https://github.com/interledger/open-payments-php/releases/tag/v1.0.0
