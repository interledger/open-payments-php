<?php

namespace OpenPayments\Models;

class WalletAddress
{
    public string $id;

    public string $publicName;

    public string $assetCode;

    public int $assetScale;

    public string $authServer;

    public string $resourceServer;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? '';
        $this->publicName = $data['publicName'] ?? '';
        $this->assetCode = $data['assetCode'] ?? '';
        $this->assetScale = $data['assetScale'] ?? 2;
        $this->authServer = $data['authServer'] ?? '';
        $this->resourceServer = $data['resourceServer'] ?? '';
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'publicName' => $this->publicName,
            'assetCode' => $this->assetCode,
            'assetScale' => $this->assetScale,
            'authServer' => $this->authServer,
            'resourceServer' => $this->resourceServer,
        ];
    }
}
