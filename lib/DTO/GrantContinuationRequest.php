<?php

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
    public ?string $interactRef;

    public function __construct(?string $interactRef = null)
    {
        $this->interactRef = $interactRef;
    }
}
