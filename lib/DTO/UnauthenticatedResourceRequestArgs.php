<?php

declare(strict_types=1);

namespace OpenPayments\DTO;

class UnauthenticatedResourceRequestArgs
{
    public readonly string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }
}
