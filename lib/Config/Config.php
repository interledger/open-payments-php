<?php

declare(strict_types=1);

namespace OpenPayments\Config;

class Config
{
    protected string $walletAddressUrl;
    protected string $privateKey;
    protected string $keyId;

    public function __construct(string $walletAddressUrl, string $privateKey, string $keyId)
    {
        $this->walletAddressUrl = $walletAddressUrl;
        $this->privateKey = $privateKey;
        $this->keyId = $keyId;
    }

    public function getWalletAddressUrl(): string
    {
        return $this->walletAddressUrl;
    }

    public function getPrivateKey(): string
    {
        return $this->privateKey;
    }

    public function getKeyId(): string
    {
        return $this->keyId;
    }
}
