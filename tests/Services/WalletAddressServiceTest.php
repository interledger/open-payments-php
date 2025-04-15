<?php

declare(strict_types=1);

use OpenPayments\ApiClient;
use OpenPayments\Models\JsonWebKeySet;
use OpenPayments\Models\WalletAddress;
use OpenPayments\Services\WalletAddressService;
use PHPUnit\Framework\TestCase;

class WalletAddressServiceTest extends TestCase
{
    private ApiClient $apiClient;

    private WalletAddressService $service;

    protected function setUp(): void
    {
        /** @var \PHPUnit\Framework\MockObject\MockObject&\OpenPayments\ApiClient $apiClient */
        $this->apiClient = $this->createMock(ApiClient::class);
        $this->service = new WalletAddressService($this->apiClient);
    }

    public function test_get_throws_exception_if_url_missing(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Missing required url for get wallet address');
        $this->service->get([]);
    }

    public function test_get_returns_wallet_address(): void
    {
        $walletData = ['id' => 'wallet123', 'address' => 'user@ilp.interledger-test.dev'];
        $this->apiClient
            ->expects($this->once())
            ->method('request')
            ->with('GET', 'https://ilp.interledger-test.dev/wallet')
            ->willReturn($walletData);

        $wallet = $this->service->get(['url' => 'https://ilp.interledger-test.dev/wallet']);

        $this->assertInstanceOf(WalletAddress::class, $wallet);
    }

    public function test_get_throws_exception_on_error_response(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->apiClient
            ->method('request')
            ->willReturn(['error' => 'not found']);

        $this->service->get(['url' => 'https://ilp.interledger-test.dev/wallet']);
    }

    public function test_get_keys_returns_json_web_key_set(): void
    {
        $keysData = ['keys' => [['kty' => 'RSA', 'alg' => 'aalg', 'kid' => 'key1']]];
        $this->apiClient
            ->expects($this->once())
            ->method('request')
            ->with('GET', 'https://ilp.interledger-test.dev/wallet/jwks.json')
            ->willReturn($keysData);

        $result = $this->service->getKeys(['url' => 'https://ilp.interledger-test.dev/wallet']);
        $this->assertInstanceOf(JsonWebKeySet::class, $result);
    }

    public function test_get_keys_throws_exception_if_url_missing(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service->getKeys([]);
    }

    public function test_get_did_document_returns_array(): void
    {
        $didData = ['id' => 'did:example:123'];
        $this->apiClient
            ->expects($this->once())
            ->method('request')
            ->with('GET', 'https://ilp.interledger-test.dev/wallet/did-document')
            ->willReturn($didData);

        $result = $this->service->getDIDDocument(['url' => 'https://ilp.interledger-test.dev/wallet']);
        $this->assertEquals($didData, $result);
    }

    public function test_get_did_document_throws_exception_if_url_missing(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service->getDIDDocument([]);
    }
}
