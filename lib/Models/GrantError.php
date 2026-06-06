<?php

declare(strict_types=1);

namespace OpenPayments\Models;

use OpenPayments\Enums\GrantErrorCode;

/**
 * Represents a structured error response from the Open Payments Authorization Server.
 *
 * The auth server wraps error details inside an `error` object with a `code` and optional `description`.
 *
 * @see https://github.com/interledger/open-payments-specifications/blob/main/openapi/auth-server.yaml
 */
class GrantError
{
    public readonly ?GrantErrorCode $code;

    public readonly ?string $description;

    public function __construct(array $data)
    {
        $errorObj = $data['error'] ?? [];
        $rawCode = $errorObj['code'] ?? null;

        $this->code = $rawCode !== null ? GrantErrorCode::tryFrom($rawCode) : null;
        $this->description = $errorObj['description'] ?? null;
    }

    public function toArray(): array
    {
        return [
            'error' => [
                'code' => $this->code?->value,
                'description' => $this->description,
            ],
        ];
    }
}
