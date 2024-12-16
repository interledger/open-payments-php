<?php

use PHPUnit\Framework\TestCase;
use OpenPayments\OpenApi\Generated\WalletAddressServer\Client as OpenApiClient;
use OpenPayments\OpenApi\Generated\WalletAddressServer\Model\WalletAddress;
use OpenPayments\OpenApi\Generated\WalletAddressServer\Model\JsonWebKeySet;
use OpenPayments\Services\WalletAddressService;

class WalletAddressServiceTest extends TestCase
{
    private $mockOpenApiClient;
    private $walletAddressService;

    protected function setUp(): void
    {
        $this->mockOpenApiClient = $this->createMock(OpenApiClient::class);
        $this->walletAddressService = new WalletAddressService($this->mockOpenApiClient);
    }

    public function testGetReturnsWalletAddress()
    {
        // Mock the WalletAddress response
        $mockResponse = $this->createMock(WalletAddress::class);
        $this->mockOpenApiClient->method('getWalletAddress')->willReturn($mockResponse);

        // Call the method
        $result = $this->walletAddressService->get();

        // Assert that the returned value is a WalletAddress
        $this->assertInstanceOf(WalletAddress::class, $result);
    }

    public function testGetThrowsExceptionOnInvalidResponse()
    {
        // Mock an invalid response
        $this->mockOpenApiClient->method('getWalletAddress')->willReturn(new \stdClass());

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Invalid WalletAddress response.");

        // Call the method
        $this->walletAddressService->get();
    }

    public function testGetKeysReturnsJsonWebKeySet()
    {
        // Mock the JsonWebKeySet response
        $mockResponse = $this->createMock(JsonWebKeySet::class);
        $this->mockOpenApiClient->method('getWalletAddressKeys')->willReturn($mockResponse);

        // Call the method
        $result = $this->walletAddressService->getKeys();

        // Assert that the returned value is a JsonWebKeySet
        $this->assertInstanceOf(JsonWebKeySet::class, $result);
    }

    public function testGetKeysThrowsExceptionOnInvalidResponse()
    {
        // Mock an invalid response
        $this->mockOpenApiClient->method('getWalletAddressKeys')->willReturn(new \stdClass());

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Invalid JWKS response.");

        // Call the method
        $this->walletAddressService->getKeys();
    }

    // Disabled test for getDIDDocument method
    // Uncomment to enable when the method is implemented in Rafiki
    public function testGetDIDDocumentReturnsResponseInterface()
    {
        // Mock the ResponseInterface response
        //$mockResponse = $this->createMock(ResponseInterface::class);
        //$this->mockOpenApiClient->method('getWalletAddressDidDocument')->willReturn($mockResponse);

        // Call the method
        //$result = $this->walletAddressService->getDIDDocument();

        // Assert that the returned value is a ResponseInterface
        //$this->assertInstanceOf(ResponseInterface::class, $result);
        $this->expectNotToPerformAssertions();
    }

    public function testGetDIDDocumentThrowsExceptionOnInvalidResponse()
    {
        // Mock an invalid response
        $this->mockOpenApiClient->method('getWalletAddressDidDocument')->willReturn(new \stdClass());

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Invalid DIDDocument response.");

        // Call the method
        $this->walletAddressService->getDIDDocument();
    }
}
