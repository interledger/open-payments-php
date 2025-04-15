<?php

declare(strict_types=1);

use OpenPayments\ApiClient;
use OpenPayments\Models\AccessToken;
use OpenPayments\Services\TokenService;
use PHPUnit\Framework\TestCase;

class TokenServiceTest extends TestCase
{
    private ApiClient $apiClient;

    private TokenService $service;

    protected function setUp(): void
    {
        /** @var \PHPUnit\Framework\MockObject\MockObject&\OpenPayments\ApiClient $apiClient */
        $this->apiClient = $this->createMock(ApiClient::class);
        $this->service = new TokenService($this->apiClient);
    }

    public function test_rotate_returns_access_token(): void
    {
        $tokenResponse = [
            'access_token' => [
                'value' => 'xyz',
                'manage' => 'manage_url',
                'access' => [
                    [
                        'type' => 'incoming-payment',
                        'actions' => ['read'],
                        'identifier' => 'incoming123',
                    ],
                ],
                'expires_in' => 3600,
            ],
        ];

        $this->apiClient->method('request')->willReturn($tokenResponse);

        $result = $this->service->rotate([
            'url' => 'https://ilp.interledger-test.dev/token/abc',
            'access_token' => 'token123',
        ]);

        $this->assertInstanceOf(AccessToken::class, $result);
    }

    public function test_rotate_throws_on_missing_url(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->service->rotate([]);
    }

    public function test_rotate_throws_on_invalid_url(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->service->rotate(['url' => 'https://ilp.interledger-test.dev/invalid']);
    }

    public function test_revoke_returns_response(): void
    {
        $response = ['status' => 'success'];

        $this->apiClient->expects($this->once())->method('request')->willReturn($response);

        $result = $this->service->revoke([
            'url' => 'https://ilp.interledger-test.dev/token/abc',
            'access_token' => 'abc123',
        ]);

        $this->assertEquals($response, $result);
    }

    public function test_revoke_throws_on_missing_data(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->service->revoke(['access_token' => 'abc123']);
    }

    public function test_revoke_throws_on_error(): void
    {
        $this->apiClient->method('request')->willReturn(['error' => 'some error']);

        $this->expectException(Exception::class);
        $this->service->revoke([
            'url' => 'https://ilp.interledger-test.dev/token/abc',
            'access_token' => 'abc123',
        ]);
    }

    public function test_build_access_token_object_throws_on_unknown_type(): void
    {
        $method = new \ReflectionMethod(TokenService::class, 'buildAccessTokenObject');
        $method->setAccessible(true);

        $this->expectException(InvalidArgumentException::class);
        $method->invokeArgs($this->service, [[
            'value' => 'token',
            'manage' => 'manage_url',
            'access' => [[
                'type' => 'unknown-type',
                'actions' => [],
            ]],
        ]]);
    }
}
