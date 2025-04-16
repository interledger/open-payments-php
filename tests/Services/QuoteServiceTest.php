<?php

declare(strict_types=1);

use OpenPayments\ApiClient;
use OpenPayments\Exceptions\CreateQuoteBadRequestException;
use OpenPayments\Exceptions\CreateQuoteForbiddenException;
use OpenPayments\Exceptions\CreateQuoteUnauthorizedException;
use OpenPayments\Exceptions\GetQuoteForbiddenException;
use OpenPayments\Exceptions\GetQuoteNotFoundException;
use OpenPayments\Exceptions\GetQuoteUnauthorizedException;
use OpenPayments\Models\Quote;
use OpenPayments\Services\QuoteService;
use PHPUnit\Framework\TestCase;

class QuoteServiceTest extends TestCase
{
    private ApiClient $apiClient;

    private QuoteService $service;

    protected function setUp(): void
    {
        /** @var \PHPUnit\Framework\MockObject\MockObject&\OpenPayments\ApiClient $apiClient */
        $this->apiClient = $this->createMock(ApiClient::class);
        $this->service = new QuoteService($this->apiClient);
    }

    public function test_get_returns_quote(): void
    {
        $response = ['id' => 'quote-123'];
        $this->apiClient->method('request')->willReturn($response);

        $result = $this->service->get([
            'url' => 'https://ilp.interledger-test.dev/quotes/quote-123',
            'access_token' => 'abc',
        ]);

        $this->assertInstanceOf(Quote::class, $result);
    }

    public function test_get_throws_unauthorized(): void
    {
        $this->expectException(GetQuoteUnauthorizedException::class);
        $this->apiClient->method('request')->willReturn([
            'status_code' => 401,
            'error' => '1',
            'message' => 'Unauthorized',
        ]);

        $this->service->get([
            'url' => 'https://ilp.interledger-test.dev/quotes/quote-123',
            'access_token' => 'abc',
        ]);
    }

    public function test_get_throws_forbidden(): void
    {
        $this->expectException(GetQuoteForbiddenException::class);
        $this->apiClient->method('request')->willReturn([
            'status_code' => 403,
            'error' => '1',
            'message' => 'Forbidden',
        ]);

        $this->service->get([
            'url' => 'https://ilp.interledger-test.dev/quotes/quote-123',
            'access_token' => 'abc',
        ]);
    }

    public function test_get_throws_not_found(): void
    {
        $this->expectException(GetQuoteNotFoundException::class);
        $this->apiClient->method('request')->willReturn([
            'status_code' => 404,
            'error' => '1',
            'message' => 'Not Found',
        ]);

        $this->service->get([
            'url' => 'https://ilp.interledger-test.dev/quotes/quote-123',
            'access_token' => 'abc',
        ]);
    }

    public function test_create_returns_quote(): void
    {
        $response = ['id' => 'quote-xyz'];
        $this->apiClient->method('request')->willReturn($response);

        $result = $this->service->create([
            'url' => 'https://ilp.interledger-test.dev',
            'access_token' => 'token',
        ], [
            'method' => 'ilp',
            'walletAddress' => 'https://ilp.interledger-test.dev/wallet',
            'receiver' => 'https://ilp.interledger-test.dev/wallet',
            'debitAmount' => [
                'value' => '1000',
                'assetCode' => 'USD',
                'assetScale' => 2,
            ],
        ]);

        $this->assertInstanceOf(Quote::class, $result);
    }

    public function test_create_throws_unauthorized(): void
    {
        $this->expectException(CreateQuoteUnauthorizedException::class);
        $this->apiClient->method('request')->willReturn([
            'status_code' => 401,
            'error' => '1',
            'message' => 'Unauthorized',
        ]);

        $this->service->create([
            'url' => 'https://ilp.interledger-test.dev',
            'access_token' => 'token',
        ], [
            'method' => 'ilp',
            'walletAddress' => 'https://ilp.interledger-test.dev/wallet',
            'receiver' => 'https://ilp.interledger-test.dev/wallet',
            'debitAmount' => [
                'value' => '1000',
                'assetCode' => 'USD',
                'assetScale' => 2,
            ],
        ]);
    }

    public function test_create_throws_forbidden(): void
    {
        $this->expectException(CreateQuoteForbiddenException::class);
        $this->apiClient->method('request')->willReturn([
            'status_code' => 403,
            'error' => '1',
            'message' => 'Forbidden',
        ]);

        $this->service->create([
            'url' => 'https://ilp.interledger-test.dev',
            'access_token' => 'token',
        ], [
            'method' => 'ilp',
            'walletAddress' => 'https://ilp.interledger-test.dev/wallet',
            'receiver' => 'https://ilp.interledger-test.dev/wallet',
            'debitAmount' => [
                'value' => '1000',
                'assetCode' => 'USD',
                'assetScale' => 2,
            ],
        ]);
    }

    public function test_create_throws_bad_request(): void
    {
        $this->expectException(CreateQuoteBadRequestException::class);
        $this->apiClient->method('request')->willReturn([
            'status_code' => 400,
            'error' => '1',
            'message' => 'Bad request',
        ]);

        $this->service->create([
            'url' => 'https://ilp.interledger-test.dev',
            'access_token' => 'token',
        ], [
            'method' => 'ilp',
            'walletAddress' => 'https://ilp.interledger-test.dev/wallet',
            'receiver' => 'https://ilp.interledger-test.dev/wallet',
            'debitAmount' => [
                'value' => '1000',
                'assetCode' => 'USD',
                'assetScale' => 2,
            ],
        ]);
    }
}
