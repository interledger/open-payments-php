<?php

namespace OpenPayments\Models;

// Base class for Grant Access
abstract class GrantAccess
{
    public string $type;

    public array $actions;
}
