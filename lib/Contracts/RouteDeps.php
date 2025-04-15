<?php

namespace OpenPayments\Contracts;

use OpenPayments\Services\OpenAPI;

interface RouteDeps extends BaseDeps
{
    public function getOpenApi(): ?OpenAPI;
}
