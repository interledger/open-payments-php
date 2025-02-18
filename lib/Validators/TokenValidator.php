<?php

namespace OpenPayments\Validators;

class TokenValidator extends AbstractValidator
{
    public function validateRotateTokenResponse(array $data): void
    {
        $schema = $this->loadSchema('Token/RotateTokenResponseSchema.json');
        $this->validate($data, $schema);
    }

    public function validateDeleteTokenResponse(array $data): void
    {
        $schema = $this->loadSchema('Token/DeleteTokenResponseSchema.json');
        $this->validate($data, $schema);
    }
}
