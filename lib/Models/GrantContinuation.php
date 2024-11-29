<?php

namespace OpenPayments\Models;

class GrantContinuation
{
    public function __construct(
        public string $id,
        public array $additionalInfo
    ) {}
}