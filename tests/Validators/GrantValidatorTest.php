<?php

namespace Tests\Validators;

use OpenPayments\Validators\GrantValidator;
use PHPUnit\Framework\TestCase;

class GrantValidatorTest extends TestCase
{
    
    public function testValidRequest(): void
    {
        $validator = new GrantValidator();

        $validData = [
            'access_token' => [
                'access' => [
                    [
                        'type' => 'quote',
                        'actions' => ['create', 'read', 'read-all']
                    ]
                ]
            ],
            'client' => 'https://ilp.interledger-test.dev/interledger'
        ];

        $this->expectNotToPerformAssertions(); // Passes if no exception is thrown
        $validator->validateRequest($validData);
    }

    public function testInvalidRequest(): void
    {
        $validator = new GrantValidator();

        $invalidData = [
            'access_token' => [
                'access' => [
                    [
                        'type' => 'invalid-type',
                        'actions' => ['create']
                    ]
                ]
            ],
            'client' => 'not-a-url'
        ];

        $this->expectException(\RuntimeException::class);
        $validator->validateRequest($invalidData);
    }
}
