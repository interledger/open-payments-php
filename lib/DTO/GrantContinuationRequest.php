<?php

declare(strict_types=1);

namespace OpenPayments\DTO;

class GrantContinuationRequestOld
{
    public function __construct(
        public string $accessToken,
        public array $additionalData = []
    ) {}
}

class GrantContinuationRequest
{
    public readonly ?string $interactRef;

    public function __construct(?string $interactRef = null)
    {
        $this->interactRef = $interactRef;
    }
}
