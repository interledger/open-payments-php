<?php

namespace Tests\Validators;

use OpenPayments\Validators\QuoteValidator;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class QuoteValidatorTest extends TestCase
{
    private QuoteValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new QuoteValidator();
    }

    public function testValidateRequestWithValidData(): void
    {
        $validData = [
            "walletAddress" => "https://ilp.interledger-test.dev/alice",
            "receiver" => "https://ilp.interledger-test.dev/incoming-payments/37a0d0ee-26dc-4c66-89e0-01fbf93156f7",
            "method" => "ilp"
        ];

        $this->expectNotToPerformAssertions();
        $this->validator->validateRequest($validData);
    }

    public function testValidateRequestWithInvalidData(): void
    {
        $invalidData = [
            "walletAddress" => "not-a-url",
            "receiver" => "https://ilp.interledger-test.dev/incoming-payments/37a0d0ee-26dc-4c66-89e0-01fbf93156f7",
        ];

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage("JSON validation failed");

        $this->validator->validateRequest($invalidData);
    }

    public function testValidateResponseWithValidData(): void
    {
        $validData = [
            "id" => "https://ilp.interledger-test.dev/quotes/ab03296b",
            "walletAddress" => "https://ilp.interledger-test.dev/alice/",
            "receiver" => "https://ilp.interledger-test.dev/bob/incoming-payments/48884225",
            "debitAmount" => [
                "value" => "2500",
                "assetCode" => "USD",
                "assetScale" => 2
            ],
            "receiveAmount" => [
                "value" => "2126",
                "assetCode" => "USD",
                "assetScale" => 2
            ],
            "method" => "ilp",
            "createdAt" => "2022-03-12T23:20:50.52Z",
            "expiresAt" => "2022-04-12T23:20:50.52Z"
        ];
        $this->expectNotToPerformAssertions();
        $this->validator->validateResponse($validData);
    }

    public function testValidateResponseWithInvalidData(): void
    {
        $invalidData = [
            "id" => "not-a-url",
            "method" => "unsupported-method" // Invalid enum value
        ];

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage("JSON validation failed");

        $this->validator->validateResponse($invalidData);
    }
}
