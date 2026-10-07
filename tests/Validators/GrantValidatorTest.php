<?php

namespace Tests\Validators;

use OpenPayments\DTO\GrantInteraction;
use OpenPayments\Exceptions\ValidationException;
use OpenPayments\Validators\GrantValidator;
use PHPUnit\Framework\TestCase;

class GrantValidatorTest extends TestCase
{
    private const JWK = [
        'kid' => 'key-1',
        'alg' => 'EdDSA',
        'use' => 'sig',
        'kty' => 'OKP',
        'crv' => 'Ed25519',
        'x' => '11qYAYKxCrfVS_7TyWQHOg7hcvPapiMlrwIaaPcHURo',
    ];

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

    public function test_client_wallet_address_object_is_valid(): void
    {
        $validator = new GrantValidator;

        $data = $this->subjectRequest();
        $data['client'] = ['walletAddress' => 'https://ilp.interledger-test.dev/interledger'];

        $this->expectNotToPerformAssertions();
        $validator->validateRequest($data);
    }

    public function test_client_jwk_object_is_valid(): void
    {
        $validator = new GrantValidator;

        $this->expectNotToPerformAssertions();
        $validator->validateRequest($this->jwkRequest(self::JWK));
    }

    public function test_client_jwk_with_wrong_alg_is_invalid(): void
    {
        $validator = new GrantValidator;

        $this->expectException(ValidationException::class);
        $validator->validateRequest($this->jwkRequest(['alg' => 'RS256'] + self::JWK));
    }

    public function test_client_jwk_with_private_key_is_invalid(): void
    {
        $validator = new GrantValidator;

        $this->expectException(ValidationException::class);
        $validator->validateRequest($this->jwkRequest(self::JWK + ['d' => 'private-key-value']));
    }

    public function test_client_jwk_with_trailing_newline_in_x_is_invalid(): void
    {
        $validator = new GrantValidator;

        $this->expectException(ValidationException::class);
        $validator->validateRequest($this->jwkRequest(['x' => substr(self::JWK['x'], 0, 42)."\n"] + self::JWK));
    }

    public function test_client_jwk_with_interact_is_invalid(): void
    {
        $validator = new GrantValidator;

        $data = $this->subjectRequest();
        $data['client'] = ['jwk' => self::JWK];

        $this->expectException(ValidationException::class);
        $validator->validateRequest($data);
    }

    public function test_client_with_jwk_and_wallet_address_is_invalid(): void
    {
        $validator = new GrantValidator;

        $data = $this->subjectRequest();
        $data['client'] = [
            'jwk' => self::JWK,
            'walletAddress' => 'https://ilp.interledger-test.dev/interledger',
        ];

        $this->expectException(ValidationException::class);
        $validator->validateRequest($data);
    }

    private function jwkRequest(array $jwk): array
    {
        return [
            'access_token' => [
                'access' => [
                    [
                        'type' => 'incoming-payment',
                        'actions' => ['create', 'read'],
                    ],
                ],
            ],
            'client' => ['jwk' => $jwk],
        ];
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
