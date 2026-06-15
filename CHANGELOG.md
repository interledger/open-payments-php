# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

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
- Initial release of open-payments-php libraryß

[1.1.0]: https://github.com/interledger/open-payments-php/compare/v1.0.2...v1.1.0
[1.0.2]: https://github.com/interledger/open-payments-php/compare/v1.0.1...v1.0.2
[1.0.1]: https://github.com/interledger/open-payments-php/compare/v1.0.0...v1.0.1
[1.0.0]: https://github.com/interledger/open-payments-php/releases/tag/v1.0.0
