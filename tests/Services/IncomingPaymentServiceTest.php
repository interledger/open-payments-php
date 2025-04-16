<?php

declare(strict_types=1);

use OpenPayments\ApiClient;
use OpenPayments\Exceptions\CompleteIncomingPaymentForbiddenException;
use OpenPayments\Exceptions\CompleteIncomingPaymentUnauthorizedException;
use OpenPayments\Exceptions\CreateIncomingPaymentForbiddenException;
use OpenPayments\Exceptions\GetIncomingPaymentNotFoundException;
use OpenPayments\Exceptions\GetIncomingPaymentUnauthorizedException;
use OpenPayments\Exceptions\ListIncomingPaymentsUnauthorizedException;
use OpenPayments\Models\IncomingPayment;
use OpenPayments\Models\IncomingPaymentsList;
use OpenPayments\Models\IncomingPaymentWithPaymentMethods;
use OpenPayments\Services\IncomingPaymentService;
use PHPUnit\Framework\TestCase;

class IncomingPaymentServiceTest extends TestCase
{
    private $apiClient;

    private $service;

    protected function setUp(): void
    {
        $this->apiClient = $this->createMock(ApiClient::class);
        $this->service = new IncomingPaymentService($this->apiClient);
    }

    public function test_get_returns_with_payment_methods()
    {
        $response = ['id' => 'incoming-payment-id'];
        $this->apiClient->method('request')->willReturn($response);

        $result = $this->service->get([
            'url' => 'https://ilp.interledger-test.dev/incoming-payments/id',
            'access_token' => 'token',
        ]);

        $this->assertInstanceOf(IncomingPaymentWithPaymentMethods::class, $result);
    }

    public function test_get_throws_unauthorized()
    {
        $this->expectException(GetIncomingPaymentUnauthorizedException::class);
        $this->apiClient->method('request')->willReturn([
            'status_code' => 401,
            'error' => '1',
            'message' => 'Authorization required',
        ]);

        $this->service->get([
            'url' => 'https://ilp.interledger-test.dev/incoming-payments/id',
            'access_token' => 'token',
        ]);

    }

    public function test_get_public_throws_not_found()
    {
        $this->expectException(GetIncomingPaymentNotFoundException::class);
        $this->apiClient->method('request')->willReturn([
            'status_code' => 404,
            'error' => '1',
            'message' => 'Incoming Payment Not Found',
        ]);

        $this->service->getPublic([
            'url' => 'https://ilp.interledger-test.dev/incoming-payments/id',
        ]);
    }

    public function test_create_throws_forbidden()
    {
        $this->expectException(CreateIncomingPaymentForbiddenException::class);
        $this->apiClient->method('request')->willReturn([
            'status_code' => 403,
            'error' => '1',
            'message' => 'Forbidden',
        ]);

        $this->service->create([
            'url' => 'https://ilp.interledger-test.dev',
            'access_token' => 'token',
        ], [
            'walletAddress' => 'https://ilp.interledger-test.dev',
            'expiresAt' => (new \DateTime)->add(new \DateInterval('PT59M'))->format("Y-m-d\TH:i:s.v\Z"),
        ]);
    }

    public function test_complete_throws_unauthorized()
    {
        $this->expectException(CompleteIncomingPaymentUnauthorizedException::class);
        $this->apiClient->method('request')->willReturn([
            'status_code' => 401,
            'error' => '1',
            'message' => 'Authorization required',
        ]);

        $this->service->complete([
            'url' => 'https://ilp.interledger-test.dev/incoming-payments/id',
            'access_token' => 'token',
        ]);
    }

    public function test_complete_throws_forbidden()
    {
        $this->expectException(CompleteIncomingPaymentForbiddenException::class);
        $this->apiClient->method('request')->willReturn([
            'status_code' => 403,
            'error' => '1',
            'message' => 'Forbidden',
        ]);

        $this->service->complete([
            'url' => 'https://ilp.interledger-test.dev/incoming-payments/id',
            'access_token' => 'token',
        ]);
    }

    public function test_list_throws_unauthorized()
    {
        $this->expectException(ListIncomingPaymentsUnauthorizedException::class);
        $this->apiClient->method('request')->willReturn([
            'status_code' => 401,
            'error' => '1',
            'message' => 'Authorization required',
        ]);

        $this->service->list([
            'url' => 'https://ilp.interledger-test.dev',
            'access_token' => 'token',
        ], [
            'wallet-address' => 'wallet123',
        ]);
    }

    public function test_get_public_returns_incoming_payment()
    {
        $response = ['some' => 'data'];
        $this->apiClient->method('request')->willReturn($response);

        $result = $this->service->getPublic([
            'url' => 'https://ilp.interledger-test.dev/incoming-payments/id',
        ]);

        $this->assertInstanceOf(IncomingPayment::class, $result);
    }

    public function test_create_returns_with_payment_methods()
    {
        $response = ['id' => 'incoming-payment-id'];
        $this->apiClient->method('request')->willReturn($response);

        $result = $this->service->create([
            'url' => 'https://ilp.interledger-test.dev',
            'access_token' => 'token',
        ], [
            'walletAddress' => 'https://ilp.interledger-test.dev',
            'expiresAt' => (new \DateTime)->add(new \DateInterval('PT59M'))->format("Y-m-d\TH:i:s.v\Z"),
        ]);

        $this->assertInstanceOf(IncomingPaymentWithPaymentMethods::class, $result);
    }

    public function test_complete_returns_with_payment_methods()
    {
        $response = ['id' => 'completed-payment'];
        $this->apiClient->method('request')->willReturn($response);

        $result = $this->service->complete([
            'url' => 'https://ilp.interledger-test.dev/incoming-payments/id',
            'access_token' => 'token',
        ]);

        $this->assertInstanceOf(IncomingPaymentWithPaymentMethods::class, $result);
    }

    public function test_list_returns_incoming_payments_list()
    {
        $response = ['items' => []];
        $this->apiClient->method('request')->willReturn($response);

        $result = $this->service->list([
            'url' => 'https://ilp.interledger-test.dev',
            'access_token' => 'token',
        ], [
            'wallet-address' => 'wallet123',
        ]);

        $this->assertInstanceOf(IncomingPaymentsList::class, $result);
    }
}
