<?php

declare(strict_types=1);

use OpenPayments\ApiClient;
use OpenPayments\Exceptions\DeleteContinueBadRequestException;
use OpenPayments\Exceptions\DeleteContinueNotFoundException;
use OpenPayments\Exceptions\DeleteContinueUnauthorizedException;
use OpenPayments\Models\Grant;
use OpenPayments\Models\PendingGrant;
use OpenPayments\Services\GrantService;
use OpenPayments\Transformers\GrantTransformer;
use OpenPayments\Transformers\PendingGrantTransformer;
use PHPUnit\Framework\TestCase;

class GrantServiceTest extends TestCase
{
    private ApiClient $apiClient;

    private GrantTransformer $grantTransformer;

    private PendingGrantTransformer $pendingTransformer;

    private GrantService $service;

    protected function setUp(): void
    {
        $this->apiClient = $this->createMock(ApiClient::class);
        $this->grantTransformer = $this->createMock(GrantTransformer::class);
        $this->pendingTransformer = $this->createMock(PendingGrantTransformer::class);

        $this->service = new GrantService(
            $this->apiClient,
            $this->grantTransformer,
            $this->pendingTransformer
        );
    }

    public function test_request_throws_if_url_missing(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service->request([], ['client_id' => 'abc']);
    }

    public function test_request_returns_pending_grant(): void
    {
        $response = [
            'interact' => ['redirect' => 'https://ilp.interledger-test.dev'],
            'continue' => ['access_token' => 'EAB18A53A6F67F9F1247'],
        ];

        $this->apiClient
            ->method('request')
            ->willReturn($response);

        $mockGrant = $this->createMock(PendingGrant::class);
        $this->pendingTransformer
            ->expects($this->once())
            ->method('createFromResponse')
            ->with($response)
            ->willReturn($mockGrant);

        $result = $this->service->request(['url' => 'https://ilp.interledger-test.dev/'], [
            'access_token' => [
                'access' => [
                    [
                        'type' => 'incoming-payment',
                        'actions' => ['read', 'create', 'list'],
                    ],
                ],
            ],
            'client' => 'https://ilp.interledger-test.dev/wallet',
        ]);
        $this->assertInstanceOf(PendingGrant::class, $result);
    }

    public function test_request_returns_grant(): void
    {
        $response = ['access_token' => 'xyz', 'continue' => ''];
        $this->apiClient->method('request')->willReturn($response);

        $mockGrant = $this->createMock(Grant::class);
        $this->grantTransformer
            ->expects($this->once())
            ->method('createFromResponse')
            ->with($response)
            ->willReturn($mockGrant);

        $result = $this->service->request(['url' => 'https://ilp.interledger-test.dev'], [
            'access_token' => [
                'access' => [
                    [
                        'type' => 'incoming-payment',
                        'actions' => ['read', 'create', 'list'],
                    ],
                ],
            ],
            'client' => 'https://ilp.interledger-test.dev/wallet',
        ]);
        $this->assertInstanceOf(Grant::class, $result);
    }

    public function test_continue_throws_if_missing_url_or_token(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service->continue(['access_token' => 'EAB18A53A6F67F9F1247'], ['interact_ref' => 'ref']);
    }

    public function test_continue_throws_if_missing_interact_ref(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service->continue(['url' => 'https://ilp.interledger-test.dev/continue/', 'access_token' => 'EAB18A53A6F67F9F1247'], []);
    }

    public function test_continue_throws_if_invalid_url(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service->continue(['url' => 'https://ilp.interledger-test.dev/not-continue/'], ['interact_ref' => 'ref']);
    }

    public function test_continue_returns_grant(): void
    {
        $response = ['access_token' => 'xyz'];
        $this->apiClient
            ->expects($this->once())
            ->method('request')
            ->willReturn($response);

        $this->grantTransformer
            ->expects($this->once())
            ->method('createFromResponse')
            ->with($response)
            ->willReturn($this->createMock(Grant::class));

        $result = $this->service->continue([
            'url' => 'https://ilp.interledger-test.dev/continue/abc',
            'access_token' => 'EAB18A53A6F67F9F1247',
        ], ['interact_ref' => 'xyz']);

        $this->assertInstanceOf(Grant::class, $result);
    }

    public function test_cancel_returns_without_error(): void
    {
        $this->apiClient
            ->method('request')
            ->willReturn(['status_code' => 204]);

        $this->service->cancel([
            'url' => 'https://ilp.interledger-test.dev/continue/abc',
            'access_token' => 'EAB18A53A6F67F9F1247',
        ]);

        $this->assertTrue(true); // No exceptions
    }

    public function test_cancel_throws_bad_request(): void
    {
        $this->expectException(DeleteContinueBadRequestException::class);
        $this->apiClient
            ->method('request')
            ->willReturn(['status_code' => 400, 'message' => 'Bad Request']);

        $this->service->cancel([
            'url' => 'https://ilp.interledger-test.dev/continue/abc',
            'access_token' => 'EAB18A53A6F67F9F1247',
        ]);
    }

    public function test_cancel_throws_unauthorized(): void
    {
        $this->expectException(DeleteContinueUnauthorizedException::class);
        $this->apiClient
            ->method('request')
            ->willReturn(['status_code' => 401, 'message' => 'Unauthorized']);

        $this->service->cancel([
            'url' => 'https://ilp.interledger-test.dev/continue/abc',
            'access_token' => 'EAB18A53A6F67F9F1247',
        ]);
    }

    public function test_cancel_throws_not_found(): void
    {
        $this->expectException(DeleteContinueNotFoundException::class);
        $this->apiClient
            ->method('request')
            ->willReturn(['status_code' => 404, 'message' => 'Not Found']);

        $this->service->cancel([
            'url' => 'https://ilp.interledger-test.dev/continue/abc',
            'access_token' => 'EAB18A53A6F67F9F1247',
        ]);
    }
}
