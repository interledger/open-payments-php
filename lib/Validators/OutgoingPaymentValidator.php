<?php

namespace OpenPayments\Validators;

class OutgoingPaymentValidator extends AbstractValidator
{
    public function validateRequest(array $data): void
    {
        $schema = $this->loadSchema('OutgoingPayment/RequestSchema.json');
        $this->validate($data, $schema);
    }

    public function validateResponse(array $data): void
    {
        $schema = $this->loadSchema('OutgoingPayment/ResponseSchema.json');
        $this->validate($data, $schema);
    }
}
