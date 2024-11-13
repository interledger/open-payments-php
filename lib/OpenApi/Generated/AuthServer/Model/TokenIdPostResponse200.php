<?php

namespace OpenPayments\OpenApi\Generated\AuthServer\Model;

class TokenIdPostResponse200 extends \ArrayObject
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
     * A single access token or set of access tokens that the client instance can use to call the RS on behalf of the RO.
     *
     * @var AccessToken
     */
    protected $accessToken;
    /**
     * A single access token or set of access tokens that the client instance can use to call the RS on behalf of the RO.
     *
     * @return AccessToken
     */
    public function getAccessToken(): AccessToken
    {
        return $this->accessToken;
    }
    /**
     * A single access token or set of access tokens that the client instance can use to call the RS on behalf of the RO.
     *
     * @param AccessToken $accessToken
     *
     * @return self
     */
    public function setAccessToken(AccessToken $accessToken): self
    {
        $this->initialized['accessToken'] = true;
        $this->accessToken = $accessToken;
        return $this;
    }
}