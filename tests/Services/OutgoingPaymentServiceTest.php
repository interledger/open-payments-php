<?php

declare(strict_types=1);

use OpenPayments\ApiClient;
use OpenPayments\Exceptions\CreateOutgoingPaymentForbiddenException;
use OpenPayments\Exceptions\CreateOutgoingPaymentUnauthorizedException;
use OpenPayments\Exceptions\GetOutgoingPaymentForbiddenException;
use OpenPayments\Exceptions\GetOutgoingPaymentNotFoundException;
use OpenPayments\Exceptions\GetOutgoingPaymentUnauthorizedException;
use OpenPayments\Exceptions\ListOutgoingPaymentsForbiddenException;
use OpenPayments\Exceptions\ListOutgoingPaymentsUnauthorizedException;
use OpenPayments\Models\OutgoingPayment;
use OpenPayments\Models\OutgoingPaymentsList;
use OpenPayments\Services\OutgoingPaymentService;
use PHPUnit\Framework\TestCase;

class OutgoingPaymentServiceTest extends TestCase
{
    private ApiClient $apiClient;

    private OutgoingPaymentService $service;

    protected function setUp(): void
    {
        $this->apiClient = $this->createMock(ApiClient::class);
        $this->service = new OutgoingPaymentService($this->apiClient);
    }

    public function test_get_returns_outgoing_payment(): void
    {
        $response = [
            'id' => 'https://ilp.interledger-test.dev/outgoing-payments/314895d2-133f-4d09-baff-8bd0e3cc3ad0',
            'failed' => false,
            'receiveAmount' => [
                'value' => '9900',
                'assetCode' => 'USD',
                'assetScale' => 2,
            ],
            'debitAmount' => [
                'value' => '10000',
                'assetCode' => 'USD',
                'assetScale' => 2,
            ],
            'sentAmount' => [
                'value' => '10000',
                'assetCode' => 'USD',
                'assetScale' => 2,
            ],
            'createdAt' => '2025-04-10T07:18:23.456Z',
            'updatedAt' => '2025-04-10T07:18:23.456Z',

        ];
        $this->apiClient->method('request')->willReturn($response);

        $result = $this->service->get([
            'url' => 'https://ilp.interledger-test.dev/outgoing-payments/314895d2-133f-4d09-baff-8bd0e3cc3ad0',
            'access_token' => 'abc',
        ]);

        $this->assertInstanceOf(OutgoingPayment::class, $result);
    }

    public function test_get_throws_unauthorized(): void
    {
        $this->expectException(GetOutgoingPaymentUnauthorizedException::class);
        $this->apiClient->method('request')->willReturn([
            'status_code' => 401,
            'error' => '1',
            'message' => 'Unauthorized',
        ]);

        $this->service->get([
            'url' => 'https://ilp.interledger-test.dev/outgoing-payments/op-123',
            'access_token' => 'abc',
        ]);
    }

    public function test_get_throws_forbidden(): void
    {
        $this->expectException(GetOutgoingPaymentForbiddenException::class);
        $this->apiClient->method('request')->willReturn([
            'status_code' => 403,
            'error' => '1',
            'message' => 'Forbidden',
        ]);

        $this->service->get([
            'url' => 'https://ilp.interledger-test.dev/outgoing-payments/op-123',
            'access_token' => 'abc',
        ]);
    }

    public function test_get_throws_not_found(): void
    {
        $this->expectException(GetOutgoingPaymentNotFoundException::class);
        $this->apiClient->method('request')->willReturn([
            'status_code' => 404,
            'error' => '1',
            'message' => 'Not Found',
        ]);

        $this->service->get([
            'url' => 'https://ilp.interledger-test.dev/outgoing-payments/op-123',
            'access_token' => 'abc',
        ]);
    }

    public function test_list_returns_outgoing_payments_list(): void
    {
        $response = ['items' => []];
        $this->apiClient->method('request')->willReturn($response);

        $result = $this->service->list([
            'url' => 'https://ilp.interledger-test.dev',
            'access_token' => 'token',
        ], [
            'wallet-address' => 'wallet123',
        ]);

        $this->assertInstanceOf(OutgoingPaymentsList::class, $result);
    }

    public function test_list_throws_unauthorized(): void
    {
        $this->expectException(ListOutgoingPaymentsUnauthorizedException::class);
        $this->apiClient->method('request')->willReturn([
            'status_code' => 401,
            'error' => '1',
            'message' => 'Unauthorized',
        ]);

        $this->service->list([
            'url' => 'https://ilp.interledger-test.dev',
            'access_token' => 'token',
        ], [
            'wallet-address' => 'wallet123',
        ]);
    }

    public function test_list_throws_forbidden(): void
    {
        $this->expectException(ListOutgoingPaymentsForbiddenException::class);
        $this->apiClient->method('request')->willReturn([
            'status_code' => 403,
            'error' => '1',
            'message' => 'Forbidden',
        ]);

        $this->service->list([
            'url' => 'https://ilp.interledger-test.dev',
            'access_token' => 'token',
        ], [
            'wallet-address' => 'https://ilp.interledger-test.dev/wallet123',
        ]);
    }

    public function test_create_returns_outgoing_payment(): void
    {
        $response = [
            'id' => 'https://ilp.interledger-test.dev/outgoing-payments/314895d2-133f-4d09-baff-8bd0e3cc3ad0',
            'failed' => false,
            'receiveAmount' => [
                'value' => '9900',
                'assetCode' => 'USD',
                'assetScale' => 2,
            ],
            'debitAmount' => [
                'value' => '10000',
                'assetCode' => 'USD',
                'assetScale' => 2,
            ],
            'sentAmount' => [
                'value' => '10000',
                'assetCode' => 'USD',
                'assetScale' => 2,
            ],
            'createdAt' => '2025-04-10T07:18:23.456Z',
            'updatedAt' => '2025-04-10T07:18:23.456Z',
        ];
        $this->apiClient->method('request')->willReturn($response);

        $result = $this->service->create([
            'url' => 'https://ilp.interledger-test.dev',
            'access_token' => 'token',
        ], [
            'walletAddress' => 'https://ilp.interledger-test.dev/wallet123',
            'quoteId' => 'https://ilp.interledger-test.dev/quotes/quote-123',
        ]);

        $this->assertInstanceOf(OutgoingPayment::class, $result);
    }

    public function test_create_throws_unauthorized(): void
    {
        $this->expectException(CreateOutgoingPaymentUnauthorizedException::class);
        $this->apiClient->method('request')->willReturn([
            'status_code' => 401,
            'error' => '1',
            'message' => 'Unauthorized',
        ]);

        $this->service->create([
            'url' => 'https://ilp.interledger-test.dev',
            'access_token' => 'token',
        ], [
            'walletAddress' => 'https://ilp.interledger-test.dev/wallet123',
            'quoteId' => 'https://ilp.interledger-test.dev/quotes/quote-123',
        ]);
    }

    public function test_create_throws_forbidden(): void
    {
        $this->expectException(CreateOutgoingPaymentForbiddenException::class);
        $this->apiClient->method('request')->willReturn([
            'status_code' => 403,
            'error' => '1',
            'message' => 'Forbidden',
        ]);

        $this->service->create([
            'url' => 'https://ilp.interledger-test.dev',
            'access_token' => 'token',
        ], [
            'walletAddress' => 'https://ilp.interledger-test.dev/wallet123',
            'quoteId' => 'https://ilp.interledger-test.dev/quotes/quote-123',
        ]);
    }
}
