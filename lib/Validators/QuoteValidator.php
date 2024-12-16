<?php

namespace OpenPayments\Validators;

class QuoteValidator extends AbstractValidator
{
    public function validateRequest(array $data): void
    {
        $schema = $this->loadSchema('Quote/RequestSchema.json');
        $this->validate($data, $schema);
    }

    public function validateResponse(array $data): void
    {
        $schema = $this->loadSchema('Quote/ResponseSchema.json');
        $this->validate($data, $schema);
    }
}
