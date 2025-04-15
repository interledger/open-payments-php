<?php

namespace Tests\Validators;

use OpenPayments\Exceptions\ValidationException;
use OpenPayments\Validators\IncomingPaymentValidator;
use PHPUnit\Framework\TestCase;

class IncomingPaymentValidatorTest extends TestCase
{
    private IncomingPaymentValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new IncomingPaymentValidator;
    }

    public function test_validate_request_with_valid_data(): void
    {
        $validData = [
            'walletAddress' => 'https://openpayments.guide/alice/',
            'incomingAmount' => [
                'value' => '2500',
                'assetCode' => 'USD',
                'assetScale' => 2,
            ],
            'metadata' => [
                'externalRef' => 'INV2022-02-0137',
            ],
        ];

        $this->expectNotToPerformAssertions(); // Passes if no exception is thrown
        $this->validator->validateRequest($validData);
    }

    public function test_validate_request_with_invalid_data(): void
    {
        $invalidData = [
            'walletAddress' => 'not-a-url',
            'incomingAmount' => [
                'value' => '2500',
                'assetCode' => 'USD',
                'assetScale' => 'two', // Invalid type
            ],
        ];

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('JSON validation failed');

        $this->validator->validateRequest($invalidData);
    }

    public function test_validate_response_with_valid_data(): void
    {
        $validData = [
            'id' => 'https://ilp.interledger-test.dev/incoming-payments/08394f02-7b7b-45e2-b645-51d04e7c330c',
            'walletAddress' => 'https://ilp.interledger-test.dev/alice/',
            'incomingAmount' => [
                'value' => '2500',
                'assetCode' => 'USD',
                'assetScale' => 2,
            ],
            'receivedAmount' => [
                'value' => '0',
                'assetCode' => 'USD',
                'assetScale' => 2,
            ],
            'completed' => false,
            'expiresAt' => '2022-02-03T23:20:50.52Z',
            'createdAt' => '2022-03-12T23:20:50.52Z',
            'updatedAt' => '2022-04-01T10:24:36.11Z',
            'metadata' => [
                'externalRef' => 'INV2022-02-0137',
            ],
            'methods' => [
                [
                    'type' => 'ilp',
                    'destination' => 'g.usd.ilpv4.dev.alice',
                    'amount' => [
                        'value' => '2500',
                        'assetCode' => 'USD',
                        'assetScale' => 2,
                    ],
                ],
            ],
        ];

        $this->expectNotToPerformAssertions(); // Passes if no exception is thrown
        $this->validator->validateResponse($validData);
    }

    public function test_validate_response_with_invalid_data(): void
    {
        $invalidData = [
            'id' => 'not-a-url',
            'completed' => 'not-a-boolean', // Invalid type
        ];

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('JSON validation failed');

        $this->validator->validateResponse($invalidData);
    }
}
