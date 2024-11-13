<?php

namespace OpenPayments\OpenApi\Generated\AuthServer\Model;

class PostBody extends \ArrayObject
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
     * @var PostBodyAccessToken
     */
    protected $accessToken;
    /**
    * Wallet address of the client instance that is making this request.
    
    When sending a non-continuation request to the AS, the client instance MUST identify itself by including the client field of the request and by signing the request.
    
    A JSON Web Key Set document, including the public key that the client instance will use to protect this request and any continuation requests at the AS and any user-facing information about the client instance used in interactions, MUST be available at the wallet address + `/jwks.json` url.
    
    If sending a grant initiation request that requires RO interaction, the wallet address MUST serve necessary client display information.
    *
    * @var string
    */
    protected $client;
    /**
     * The client instance declares the parameters for interaction methods that it can support using the interact field.
     *
     * @var InteractRequest
     */
    protected $interact;
    /**
     * 
     *
     * @return PostBodyAccessToken
     */
    public function getAccessToken(): PostBodyAccessToken
    {
        return $this->accessToken;
    }
    /**
     * 
     *
     * @param PostBodyAccessToken $accessToken
     *
     * @return self
     */
    public function setAccessToken(PostBodyAccessToken $accessToken): self
    {
        $this->initialized['accessToken'] = true;
        $this->accessToken = $accessToken;
        return $this;
    }
    /**
    * Wallet address of the client instance that is making this request.
    
    When sending a non-continuation request to the AS, the client instance MUST identify itself by including the client field of the request and by signing the request.
    
    A JSON Web Key Set document, including the public key that the client instance will use to protect this request and any continuation requests at the AS and any user-facing information about the client instance used in interactions, MUST be available at the wallet address + `/jwks.json` url.
    
    If sending a grant initiation request that requires RO interaction, the wallet address MUST serve necessary client display information.
    *
    * @return string
    */
    public function getClient(): string
    {
        return $this->client;
    }
    /**
    * Wallet address of the client instance that is making this request.
    
    When sending a non-continuation request to the AS, the client instance MUST identify itself by including the client field of the request and by signing the request.
    
    A JSON Web Key Set document, including the public key that the client instance will use to protect this request and any continuation requests at the AS and any user-facing information about the client instance used in interactions, MUST be available at the wallet address + `/jwks.json` url.
    
    If sending a grant initiation request that requires RO interaction, the wallet address MUST serve necessary client display information.
    *
    * @param string $client
    *
    * @return self
    */
    public function setClient(string $client): self
    {
        $this->initialized['client'] = true;
        $this->client = $client;
        return $this;
    }
    /**
     * The client instance declares the parameters for interaction methods that it can support using the interact field.
     *
     * @return InteractRequest
     */
    public function getInteract(): InteractRequest
    {
        return $this->interact;
    }
    /**
     * The client instance declares the parameters for interaction methods that it can support using the interact field.
     *
     * @param InteractRequest $interact
     *
     * @return self
     */
    public function setInteract(InteractRequest $interact): self
    {
        $this->initialized['interact'] = true;
        $this->interact = $interact;
        return $this;
    }
}