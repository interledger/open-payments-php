<?php

namespace OpenPayments\OpenApi\Generated\AuthServer\Model;

class AccessToken
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
     * The value of the access token as a string.  The value is opaque to the client instance.  The value SHOULD be limited to ASCII characters to facilitate transmission over HTTP headers within other protocols without requiring additional encoding.
     *
     * @var string
     */
    protected $value;
    /**
     * The management URI for this access token. This URI MUST NOT include the access token value and SHOULD be different for each access token issued in a request.
     *
     * @var string
     */
    protected $manage;
    /**
     * The number of seconds in which the access will expire.  The client instance MUST NOT use the access token past this time.  An RS MUST NOT accept an access token past this time.
     *
     * @var int
     */
    protected $expiresIn;
    /**
     * A description of the rights associated with this access token.
     *
     * @var list<mixed>
     */
    protected $access;
    /**
     * The value of the access token as a string.  The value is opaque to the client instance.  The value SHOULD be limited to ASCII characters to facilitate transmission over HTTP headers within other protocols without requiring additional encoding.
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
    /**
     * The value of the access token as a string.  The value is opaque to the client instance.  The value SHOULD be limited to ASCII characters to facilitate transmission over HTTP headers within other protocols without requiring additional encoding.
     *
     * @param string $value
     *
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->initialized['value'] = true;
        $this->value = $value;
        return $this;
    }
    /**
     * The management URI for this access token. This URI MUST NOT include the access token value and SHOULD be different for each access token issued in a request.
     *
     * @return string
     */
    public function getManage(): string
    {
        return $this->manage;
    }
    /**
     * The management URI for this access token. This URI MUST NOT include the access token value and SHOULD be different for each access token issued in a request.
     *
     * @param string $manage
     *
     * @return self
     */
    public function setManage(string $manage): self
    {
        $this->initialized['manage'] = true;
        $this->manage = $manage;
        return $this;
    }
    /**
     * The number of seconds in which the access will expire.  The client instance MUST NOT use the access token past this time.  An RS MUST NOT accept an access token past this time.
     *
     * @return int
     */
    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }
    /**
     * The number of seconds in which the access will expire.  The client instance MUST NOT use the access token past this time.  An RS MUST NOT accept an access token past this time.
     *
     * @param int $expiresIn
     *
     * @return self
     */
    public function setExpiresIn(int $expiresIn): self
    {
        $this->initialized['expiresIn'] = true;
        $this->expiresIn = $expiresIn;
        return $this;
    }
    /**
     * A description of the rights associated with this access token.
     *
     * @return list<mixed>
     */
    public function getAccess(): array
    {
        return $this->access;
    }
    /**
     * A description of the rights associated with this access token.
     *
     * @param list<mixed> $access
     *
     * @return self
     */
    public function setAccess(array $access): self
    {
        $this->initialized['access'] = true;
        $this->access = $access;
        return $this;
    }
    public function toArray()
    {
        return [
            'value' => $this->value,
            'manage' => $this->manage,
            'expires_in' => $this->expiresIn,
            'access' => $this->access
        ];
    }
}