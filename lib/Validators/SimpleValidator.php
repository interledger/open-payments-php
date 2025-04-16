<?php

namespace OpenPayments\Validators;

class SimpleValidator extends AbstractValidator
{
    public function validateSimple(array $data): void
    {
        $schema = $this->loadSchema('Grant/SimpleSchema.json');
        $this->validate($data, $schema);
    }

    public function validateResponse(array $data): void
    {
        $schema = $this->loadSchema('Grant/ResponseSchema.json');
        $this->validate($data, $schema);
    }
}
