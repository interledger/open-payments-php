<?php

namespace OpenPayments\Validators;

class GrantValidator extends AbstractValidator
{
    public function validateRequest(array $data): void
    {
        $schema = $this->loadSchema('Grant/RequestSchema.json');
        $this->validate($data, $schema);
    }

    public function validateResponse(array $data): void
    {
        $schema = $this->loadSchema('Grant/ResponseSchema.json');
        $this->validate($data, $schema);
    }
}
