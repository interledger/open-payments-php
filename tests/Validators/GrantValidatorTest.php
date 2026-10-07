<?php

namespace Tests\Validators;

use OpenPayments\DTO\GrantInteraction;
use OpenPayments\Exceptions\ValidationException;
use OpenPayments\Validators\GrantValidator;
use PHPUnit\Framework\TestCase;

class GrantValidatorTest extends TestCase
{
    public function test_valid_request(): void
    {
        $validator = new GrantValidator;

        $validData = [
            'access_token' => [
                'access' => [
                    [
                        'type' => 'quote',
                        'actions' => ['create', 'read', 'read-all'],
                    ],
                ],
            ],
            'client' => 'https://ilp.interledger-test.dev/interledger',
        ];

        $this->expectNotToPerformAssertions(); // Passes if no exception is thrown
        $validator->validateRequest($validData);
    }

    public function test_invalid_request(): void
    {
        $validator = new GrantValidator;

        $invalidData = [
            'access_token' => [
                'access' => [
                    [
                        'type' => 'invalid-type',
                        'actions' => ['create'],
                    ],
                ],
            ],
            'client' => 'not-a-url',
        ];

        $this->expectException(ValidationException::class);
        $validator->validateRequest($invalidData);
    }

    public function test_valid_subject_request(): void
    {
        $validator = new GrantValidator;

        $this->expectNotToPerformAssertions();
        $validator->validateRequest($this->subjectRequest());
    }

    public function test_subject_request_without_interact_is_invalid(): void
    {
        $validator = new GrantValidator;

        $data = $this->subjectRequest();
        unset($data['interact']);

        $this->expectException(ValidationException::class);
        $validator->validateRequest($data);
    }

    public function test_request_without_access_token_or_subject_is_invalid(): void
    {
        $validator = new GrantValidator;

        $data = $this->subjectRequest();
        unset($data['subject']);

        $this->expectException(ValidationException::class);
        $validator->validateRequest($data);
    }

    public function test_subject_request_with_empty_sub_ids_is_invalid(): void
    {
        $validator = new GrantValidator;

        $data = $this->subjectRequest();
        $data['subject']['sub_ids'] = [];

        $this->expectException(ValidationException::class);
        $validator->validateRequest($data);
    }

    public function test_subject_request_with_unknown_format_is_invalid(): void
    {
        $validator = new GrantValidator;

        $data = $this->subjectRequest();
        $data['subject']['sub_ids'][0]['format'] = 'email';

        $this->expectException(ValidationException::class);
        $validator->validateRequest($data);
    }

    public function test_request_with_access_token_and_subject_is_valid(): void
    {
        $validator = new GrantValidator;

        $data = $this->subjectRequest();
        $data['access_token'] = [
            'access' => [
                [
                    'type' => 'quote',
                    'actions' => ['create', 'read'],
                ],
            ],
        ];

        $this->expectNotToPerformAssertions();
        $validator->validateRequest($data);
    }

    public function test_subject_request_with_invalid_interact_is_invalid(): void
    {
        $validator = new GrantValidator;

        $data = $this->subjectRequest();
        $data['interact'] = ['finish' => $data['interact']['finish']];

        $this->expectException(ValidationException::class);
        $validator->validateRequest($data);
    }

    public function test_request_with_interaction_dto_without_finish_is_valid(): void
    {
        $validator = new GrantValidator;

        $data = $this->subjectRequest();
        $data['interact'] = (new GrantInteraction(['redirect']))->toArray();

        $this->expectNotToPerformAssertions();
        $validator->validateRequest($data);
    }

    private function subjectRequest(): array
    {
        return [
            'subject' => [
                'sub_ids' => [
                    [
                        'id' => 'https://ilp.interledger-test.dev/alice',
                        'format' => 'uri',
                    ],
                ],
            ],
            'client' => 'https://ilp.interledger-test.dev/interledger',
            'interact' => [
                'start' => ['redirect'],
                'finish' => [
                    'method' => 'redirect',
                    'uri' => 'https://example.com/finish',
                    'nonce' => 'nonce-123',
                ],
            ],
        ];
    }
}
