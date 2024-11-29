<?php

namespace OpenPayments\DTO;

class UnauthenticatedResourceRequestArgs
{
    public string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }
}
