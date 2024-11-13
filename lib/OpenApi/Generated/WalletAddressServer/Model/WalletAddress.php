<?php

namespace OpenPayments\OpenApi\Generated\WalletAddressServer\Model;

class WalletAddress extends \ArrayObject
{
    /**
     * @var array
     */
    protected $initialized = [];
    public function isInitialized($property): bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
     * The URL identifying the wallet address.
     *
     * @var string
     */
    protected $id;
    /**
     * A public name for the account. This should be set by the account holder with their provider to provide a hint to counterparties as to the identity of the account holder.
     *
     * @var string
     */
    protected $publicName;
    /**
     * The assetCode is a code that indicates the underlying asset. This SHOULD be an ISO4217 currency code.
     *
     * @var string
     */
    protected $assetCode;
    /**
     * The scale of amounts denoted in the corresponding asset code.
     *
     * @var int
     */
    protected $assetScale;
    /**
     * The URL of the authorization server endpoint for getting grants and access tokens for this wallet address.
     *
     * @var string
     */
    protected $authServer;
    /**
     * The URL of the resource server endpoint for performing Open Payments with this wallet address.
     *
     * @var string
     */
    protected $resourceServer;
    /**
     * The URL identifying the wallet address.
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
    /**
     * The URL identifying the wallet address.
     *
     * @param string $id
     *
     * @return self
     */
    public function setId(string $id): self
    {
        $this->initialized['id'] = true;
        $this->id = $id;
        return $this;
    }
    /**
     * A public name for the account. This should be set by the account holder with their provider to provide a hint to counterparties as to the identity of the account holder.
     *
     * @return string
     */
    public function getPublicName(): string
    {
        return $this->publicName;
    }
    /**
     * A public name for the account. This should be set by the account holder with their provider to provide a hint to counterparties as to the identity of the account holder.
     *
     * @param string $publicName
     *
     * @return self
     */
    public function setPublicName(string $publicName): self
    {
        $this->initialized['publicName'] = true;
        $this->publicName = $publicName;
        return $this;
    }
    /**
     * The assetCode is a code that indicates the underlying asset. This SHOULD be an ISO4217 currency code.
     *
     * @return string
     */
    public function getAssetCode(): string
    {
        return $this->assetCode;
    }
    /**
     * The assetCode is a code that indicates the underlying asset. This SHOULD be an ISO4217 currency code.
     *
     * @param string $assetCode
     *
     * @return self
     */
    public function setAssetCode(string $assetCode): self
    {
        $this->initialized['assetCode'] = true;
        $this->assetCode = $assetCode;
        return $this;
    }
    /**
     * The scale of amounts denoted in the corresponding asset code.
     *
     * @return int
     */
    public function getAssetScale(): int
    {
        return $this->assetScale;
    }
    /**
     * The scale of amounts denoted in the corresponding asset code.
     *
     * @param int $assetScale
     *
     * @return self
     */
    public function setAssetScale(int $assetScale): self
    {
        $this->initialized['assetScale'] = true;
        $this->assetScale = $assetScale;
        return $this;
    }
    /**
     * The URL of the authorization server endpoint for getting grants and access tokens for this wallet address.
     *
     * @return string
     */
    public function getAuthServer(): string
    {
        return $this->authServer;
    }
    /**
     * The URL of the authorization server endpoint for getting grants and access tokens for this wallet address.
     *
     * @param string $authServer
     *
     * @return self
     */
    public function setAuthServer(string $authServer): self
    {
        $this->initialized['authServer'] = true;
        $this->authServer = $authServer;
        return $this;
    }
    /**
     * The URL of the resource server endpoint for performing Open Payments with this wallet address.
     *
     * @return string
     */
    public function getResourceServer(): string
    {
        return $this->resourceServer;
    }
    /**
     * The URL of the resource server endpoint for performing Open Payments with this wallet address.
     *
     * @param string $resourceServer
     *
     * @return self
     */
    public function setResourceServer(string $resourceServer): self
    {
        $this->initialized['resourceServer'] = true;
        $this->resourceServer = $resourceServer;
        return $this;
    }
}
