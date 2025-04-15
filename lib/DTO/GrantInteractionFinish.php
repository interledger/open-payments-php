<?php

namespace OpenPayments\DTO;

class GrantInteractionFinish
{
    public string $method; // Always "redirect"

    public string $uri;

    public string $nonce;

    public function __construct(string $method, string $uri, string $nonce)
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->nonce = $nonce;
    }

    /**
     * Convert the DTO to an associative array.
     */
    public function toArray(): array
    {
        return [
            'method' => $this->method,
            'uri' => $this->uri,
            'nonce' => $this->nonce,
        ];
    }
}
