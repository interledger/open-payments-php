<?php

namespace OpenPayments\OpenApi\Generated\AuthServer\Model;

class ContinueIdPostResponse200 extends \ArrayObject
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
     * If the AS determines that the request can be continued with additional requests, it responds with the continue field.
     *
     * @var _Continue
     */
    protected $continue;
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
    /**
     * If the AS determines that the request can be continued with additional requests, it responds with the continue field.
     *
     * @return _Continue
     */
    public function getContinue(): _Continue
    {
        return $this->continue;
    }
    /**
     * If the AS determines that the request can be continued with additional requests, it responds with the continue field.
     *
     * @param _Continue $continue
     *
     * @return self
     */
    public function setContinue(_Continue $continue): self
    {
        $this->initialized['continue'] = true;
        $this->continue = $continue;
        return $this;
    }
    public function toArray()
    {
        return [
            'accessToken' => $this->accessToken->toArray(),
            'continue' => $this->continue->toArray()
        ];
    }
}