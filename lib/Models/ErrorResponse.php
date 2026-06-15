<?php

declare(strict_types=1);

namespace OpenPayments\Models;

/**
 * Represents a generic error response from the Open Payments resource server.
 *
 * @see https://openpayments.dev
 */
class ErrorResponse
{
    public readonly string $error;

    public readonly ?string $message;

    public function __construct(array $data)
    {
        $this->error = $data['error'] ?? '';
        $this->message = $data['message'] ?? null;
    }

    public function toArray(): array
    {
        $result = ['error' => $this->error];
        if ($this->message !== null) {
            $result['message'] = $this->message;
        }

        return $result;
    }
}
