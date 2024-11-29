<?php

declare(strict_types=1);

namespace OpenPayments\Config;

class Config
{
    protected string $walletAddressUrl;
    protected string $privateKey;
    protected string $keyId;
    protected bool $useHttp;

    public function __construct(string $walletAddressUrl, string $privateKey, string $keyId, bool $useHttp = false)
    {
        $this->walletAddressUrl = $walletAddressUrl;
        $this->privateKey = $privateKey;
        $this->keyId = $keyId;
        $this->useHttp = $useHttp;
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
