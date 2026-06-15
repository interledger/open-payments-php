<?php

declare(strict_types=1);

namespace OpenPayments\Traits;

use OpenPayments\Models\ErrorResponse;
use OpenPayments\Models\GrantError;

/**
 * Allows an exception to carry a parsed typed error model from the API response.
 *
 * Use withErrorResponse() or withGrantError() to attach the model after construction.
 */
trait HasErrorResponse
{
    private ?ErrorResponse $errorResponse = null;

    private ?GrantError $grantError = null;

    public function withErrorResponse(ErrorResponse $errorResponse): static
    {
        $this->errorResponse = $errorResponse;

        return $this;
    }

    public function getErrorResponse(): ?ErrorResponse
    {
        return $this->errorResponse;
    }

    public function withGrantError(GrantError $grantError): static
    {
        $this->grantError = $grantError;

        return $this;
    }

    public function getGrantError(): ?GrantError
    {
        return $this->grantError;
    }
}
