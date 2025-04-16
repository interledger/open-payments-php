<?php

namespace Tests\Validators;

use OpenPayments\Exceptions\ValidationException;
use OpenPayments\Validators\OutgoingPaymentValidator;
use PHPUnit\Framework\TestCase;

class OutgoingPaymentValidatorTest extends TestCase
{
    private OutgoingPaymentValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new OutgoingPaymentValidator;
    }

    public function test_validate_request_with_valid_data_based_on_a_quote(): void
    {
        $validData = [
            'walletAddress' => 'https://ilp.interledger-test.dev/alice/',
            'quoteId' => 'https://ilp.interledger-test.dev/quotes/733fee29-dfcf-4fd6-8bda-0c89103ffeb7',
            'metadata' => [
                'externalRef' => 'INV2024-12-1337',
            ],
        ];
        $this->expectNotToPerformAssertions();
        $this->validator->validateRequest($validData);
    }

    public function test_validate_request_with_valid_data_based_on_an_incoming_payment(): void
    {
        $validData = [
            'walletAddress' => 'https://ilp.interledger-test.dev/alice/',
            'incomingPayment' => 'https://ilp.interledger-test.dev/bob/incoming-payments/48884225',
            'debitAmount' => [
                'value' => '2500',
                'assetCode' => 'USD',
                'assetScale' => 2,
            ],
            'metadata' => [
                'externalRef' => 'INV2024-12-0137',
            ],
        ];
        $this->expectNotToPerformAssertions();
        $this->validator->validateRequest($validData);
    }

    public function test_validate_response_with_invalid_data(): void
    {
        $invalidData = [
            'id' => 'not-a-url',
            'walletAddress' => null, // Missing required field
        ];

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('JSON validation failed');

        $this->validator->validateResponse($invalidData);
    }
}
