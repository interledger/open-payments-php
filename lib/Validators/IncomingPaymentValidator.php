<?php

namespace OpenPayments\Validators;

class IncomingPaymentValidator extends AbstractValidator
{
    public function validateRequest(array $data): void
    {
        $schema = $this->loadSchema('IncomingPayment/RequestSchema.json');
        $this->validate($data, $schema);
    }

    public function validateResponse(array $data): void
    {
        $schema = $this->loadSchema('IncomingPayment/ResponseSchema.json');
        $this->validate($data, $schema);
    }
}
