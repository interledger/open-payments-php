<?php

namespace OpenPayments\OpenApi\Generated\AuthServer\Model;

class _Continue extends \ArrayObject
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
     * A unique access token for continuing the request, called the "continuation access token".
     *
     * @var ContinueAccessToken
     */
    protected $accessToken;
    /**
     * The URI at which the client instance can make continuation requests.
     *
     * @var string
     */
    protected $uri;
    /**
     * The amount of time in integer seconds the client instance MUST wait after receiving this request continuation response and calling the continuation URI.
     *
     * @var int
     */
    protected $wait;
    /**
     * A unique access token for continuing the request, called the "continuation access token".
     *
     * @return ContinueAccessToken
     */
    public function getAccessToken(): ContinueAccessToken
    {
        return $this->accessToken;
    }
    /**
     * A unique access token for continuing the request, called the "continuation access token".
     *
     * @param ContinueAccessToken $accessToken
     *
     * @return self
     */
    public function setAccessToken(ContinueAccessToken $accessToken): self
    {
        $this->initialized['accessToken'] = true;
        $this->accessToken = $accessToken;
        return $this;
    }
    /**
     * The URI at which the client instance can make continuation requests.
     *
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }
    /**
     * The URI at which the client instance can make continuation requests.
     *
     * @param string $uri
     *
     * @return self
     */
    public function setUri(string $uri): self
    {
        $this->initialized['uri'] = true;
        $this->uri = $uri;
        return $this;
    }
    /**
     * The amount of time in integer seconds the client instance MUST wait after receiving this request continuation response and calling the continuation URI.
     *
     * @return int
     */
    public function getWait(): int
    {
        return $this->wait;
    }
    /**
     * The amount of time in integer seconds the client instance MUST wait after receiving this request continuation response and calling the continuation URI.
     *
     * @param int $wait
     *
     * @return self
     */
    public function setWait(int $wait): self
    {
        $this->initialized['wait'] = true;
        $this->wait = $wait;
        return $this;
    }
    public function toArray()
    {
        return [
            'access_token' => $this->accessToken->toArray(),
            'uri' => $this->uri,
            'wait' => $this->wait,
        ];
    }
}