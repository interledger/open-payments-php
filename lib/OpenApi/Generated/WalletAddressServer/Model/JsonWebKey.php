<?php

namespace OpenPayments\OpenApi\Generated\WalletAddressServer\Model;

class JsonWebKey extends \ArrayObject
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
     *
     *
     * @var string
     */
    protected $kid;
    /**
     * The cryptographic algorithm family used with the key. The only allowed value is `EdDSA`.
     *
     * @var string
     */
    protected $alg;
    /**
     *
     *
     * @var string
     */
    protected $use;
    /**
     *
     *
     * @var string
     */
    protected $kty;
    /**
     *
     *
     * @var string
     */
    protected $crv;
    /**
     * The base64 url-encoded public key.
     *
     * @var string
     */
    protected $x;
    /**
     *
     *
     * @return string
     */
    public function getKid(): string
    {
        return $this->kid;
    }
    /**
     *
     *
     * @param string $kid
     *
     * @return self
     */
    public function setKid(string $kid): self
    {
        $this->initialized['kid'] = true;
        $this->kid = $kid;
        return $this;
    }
    /**
     * The cryptographic algorithm family used with the key. The only allowed value is `EdDSA`.
     *
     * @return string
     */
    public function getAlg(): string
    {
        return $this->alg;
    }
    /**
     * The cryptographic algorithm family used with the key. The only allowed value is `EdDSA`.
     *
     * @param string $alg
     *
     * @return self
     */
    public function setAlg(string $alg): self
    {
        $this->initialized['alg'] = true;
        $this->alg = $alg;
        return $this;
    }
    /**
     *
     *
     * @return string
     */
    public function getUse(): string
    {
        return $this->use;
    }
    /**
     *
     *
     * @param string $use
     *
     * @return self
     */
    public function setUse(string $use): self
    {
        $this->initialized['use'] = true;
        $this->use = $use;
        return $this;
    }
    /**
     *
     *
     * @return string
     */
    public function getKty(): string
    {
        return $this->kty;
    }
    /**
     *
     *
     * @param string $kty
     *
     * @return self
     */
    public function setKty(string $kty): self
    {
        $this->initialized['kty'] = true;
        $this->kty = $kty;
        return $this;
    }
    /**
     *
     *
     * @return string
     */
    public function getCrv(): string
    {
        return $this->crv;
    }
    /**
     *
     *
     * @param string $crv
     *
     * @return self
     */
    public function setCrv(string $crv): self
    {
        $this->initialized['crv'] = true;
        $this->crv = $crv;
        return $this;
    }
    /**
     * The base64 url-encoded public key.
     *
     * @return string
     */
    public function getX(): string
    {
        return $this->x;
    }
    /**
     * The base64 url-encoded public key.
     *
     * @param string $x
     *
     * @return self
     */
    public function setX(string $x): self
    {
        $this->initialized['x'] = true;
        $this->x = $x;
        return $this;
    }
}
