<?php

namespace OpenPayments;

use OpenPayments\Config\Config;
use OpenPayments\Services\GrantService;
use OpenPayments\Services\IncomingPaymentService;
use OpenPayments\Services\OutgoingPaymentService;
use OpenPayments\Services\QuoteService;
use OpenPayments\Services\TokenService;
use OpenPayments\Services\WalletAddressService;

class AuthClient
{
    private Config $config;

    private ApiClient $apiClient;

    private ?WalletAddressService $walletService = null;

    private ?IncomingPaymentService $incomingPaymentService = null;

    private ?QuoteService $quoteService = null;

    private ?OutgoingPaymentService $outgoingPaymentService = null;

    private ?GrantService $grantService = null;

    private ?TokenService $tokenService = null;

    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->apiClient = new ApiClient(
            $this->config->getPrivateKey(),
            $this->config->getKeyId()
        );
    }

    public function setAccessToken(string $token): void
    {
        $this->apiClient->setAccessToken($token);
    }

    public function walletAddress(): WalletAddressService
    {
        if (! $this->walletService) {
            $this->walletService = new WalletAddressService($this->apiClient, $this->config->getWalletAddressUrl());
        }

        return $this->walletService;
    }

    public function incomingPayment(string $authServerUrl = ''): IncomingPaymentService
    {
        if (! $this->incomingPaymentService) {
            $this->incomingPaymentService = new IncomingPaymentService($this->apiClient);
        }

        return $this->incomingPaymentService;
    }

    public function quote(): QuoteService
    {
        if (! $this->quoteService) {
            $this->quoteService = new QuoteService($this->apiClient);
        }

        return $this->quoteService;
    }

    public function outgoingPayment(): OutgoingPaymentService
    {
        if (! $this->outgoingPaymentService) {
            $this->outgoingPaymentService = new OutgoingPaymentService($this->apiClient);
        }

        return $this->outgoingPaymentService;
    }

    public function grant(): GrantService
    {
        if (! $this->grantService) {
            $this->grantService = new GrantService($this->apiClient);
        }

        return $this->grantService;
    }

    public function token(): TokenService
    {
        if (! $this->tokenService) {
            $this->tokenService = new TokenService($this->apiClient);
        }

        return $this->tokenService;
    }
}
